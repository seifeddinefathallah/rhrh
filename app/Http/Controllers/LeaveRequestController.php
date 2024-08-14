<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use App\Models\LeaveType;
use Berkayk\OneSignal\OneSignalFacade as OneSignal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Models\LeaveBalance;
use App\Mail\LeaveRequestRejected;
use App\Mail\LeaveRequestApproved;
use App\Mail\LeaveRequestCreated;

class LeaveRequestController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    // Display the list of leave requests
    public function index()
    {
        $leaveRequests = LeaveRequest::with('leaveType')->get();
        return view('leave_requests.index', compact('leaveRequests'));
    }

    // Display the form for creating a leave request
    public function create()
    {
        $leaveTypes = LeaveType::all();
        return view('leave_requests.create', compact('leaveTypes'));
    }

    // Store a new leave request
    public function store(Request $request)
    {
        $leaveType = LeaveType::find($request->leave_type_id);

        if (!$leaveType) {
            return redirect()->back()->withErrors(['leave_type_id' => 'Invalid leave type.']);
        }

        $rules = [
            'leave_type_id' => 'required|exists:leave_types,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'nullable|string',
        ];

        // If medical certificate is required, add validation rules
        if ($leaveType->requires_medical_certificate) {
            $rules['medical_certificate'] = 'nullable|file|mimes:pdf,jpeg,png|max:2048';
        }

        $request->validate($rules);

        $medicalCertificatePath = null;
        if ($request->hasFile('medical_certificate')) {
            // Store the file and log the path
            $medicalCertificatePath = $request->file('medical_certificate')->store('public/medical_certificates');
            Log::info('Medical certificate uploaded to: ' . $medicalCertificatePath);
        }

        // Set the deadline for uploading the medical certificate
        $certificateUploadDeadline = null;
        if ($leaveType->requires_medical_certificate) {
            $certificateUploadDeadline = now()->addHours(48);
        }

        // Create the leave request
        $leaveRequest = LeaveRequest::create([
            'employee_id' => Auth::user()->employee->id,
            'leave_type_id' => $request->leave_type_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason' => $request->reason,
            'medical_certificate' => $medicalCertificatePath,
            'certificate_upload_deadline' => $certificateUploadDeadline,
        ]);

        // Send email notification to the employee
        Mail::to($leaveRequest->employee->user->email)->send(new LeaveRequestCreated($leaveRequest));

        return redirect()->route('leave_requests.index')
            ->with('success', 'Leave request submitted successfully. You have 48 hours to upload the medical certificate.');
    }

    // Display the form for editing a leave request
    public function edit(LeaveRequest $leaveRequest)
    {
        $leaveTypes = LeaveType::all();
        return view('leave_requests.edit', compact('leaveRequest', 'leaveTypes'));
    }

    // Update an existing leave request
    public function update(Request $request, LeaveRequest $leaveRequest)
    {
        $leaveType = LeaveType::findOrFail($request->leave_type_id);

        $rules = [
            'leave_type_id' => 'required|exists:leave_types,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'nullable|string',
        ];

        // If medical certificate is required, add validation rules
        if ($leaveType->requires_medical_certificate) {
            $rules['medical_certificate'] = 'nullable|file|mimes:pdf,jpeg,png|max:2048';
        }

        $request->validate($rules);

        $medicalCertificatePath = $leaveRequest->medical_certificate;
        if ($request->hasFile('medical_certificate')) {
            // Delete the old file if a new one is uploaded
            if ($medicalCertificatePath) {
                Storage::delete($medicalCertificatePath);
                Log::info('Old medical certificate deleted: ' . $medicalCertificatePath);
            }
            $medicalCertificatePath = $request->file('medical_certificate')->store('medical_certificates');
            Log::info('New medical certificate uploaded to: ' . $medicalCertificatePath);
        }

        // Update the leave request
        $leaveRequest->update([
            'leave_type_id' => $request->leave_type_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason' => $request->reason,
            'medical_certificate' => $medicalCertificatePath,
        ]);

        return redirect()->route('leave_requests.index')
            ->with('success', 'Leave request updated successfully.');
    }

    // Delete a leave request
    public function destroy(LeaveRequest $leaveRequest)
    {
        // Delete the associated medical certificate if it exists
        if ($leaveRequest->medical_certificate) {
            Storage::delete($leaveRequest->medical_certificate);
            Log::info('Medical certificate deleted: ' . $leaveRequest->medical_certificate);
        }

        $leaveRequest->delete();

        return redirect()->route('leave_requests.index')
            ->with('success', 'Leave request deleted successfully.');
    }

    public function approve(LeaveRequest $leaveRequest)
    {
        try {
            $startDate = Carbon::parse($leaveRequest->start_date);
            $endDate = Carbon::parse($leaveRequest->end_date);
            $duration = $startDate->diffInDays($endDate) + 1; // Include the end date

            $leaveType = $leaveRequest->leaveType;
            $employee = $leaveRequest->employee;

            // Check leave balance
            $leaveBalance = LeaveBalance::where('employee_id', $employee->id)
                ->where('leave_type_id', $leaveType->id)
                ->first();

            if (!$leaveBalance || $leaveBalance->remaining_days < $duration) {
                return redirect()->route('leave_requests.index')
                    ->withErrors('Insufficient leave balance.');
            }

            // Approve the request and update leave balance
            $leaveRequest->update(['status' => 'approved']);
            $leaveBalance->remaining_days -= $duration;
            $leaveBalance->save();

            Mail::to($leaveRequest->employee->user->email)->send(new LeaveRequestApproved($leaveRequest));

            // Send notification
            $notificationMessage = "Leave request approved.";
            $employeeSubscriptions = DB::table('push_subscriptions')
                ->where('user_id', $employee->user_id)
                ->pluck('subscription_id')
                ->toArray();

            $this->sendOneSignalNotification($notificationMessage, $employeeSubscriptions, 'approved');

            return redirect()->route('leave_requests.index')
                ->with('success', 'Leave request approved successfully.');
        } catch (\Exception $e) {
            return redirect()->route('leave_requests.index')
                ->with('error', 'Error approving leave request: ' . $e->getMessage());
        }
    }

    public function reject(LeaveRequest $leaveRequest)
    {
        try {
            if ($leaveRequest->leaveType->requires_medical_certificate) {
                return redirect()->route('leave_requests.index')
                    ->with('error', 'Leave requests requiring a medical certificate cannot be rejected.');
            }

            $leaveRequest->update(['status' => 'rejected']);

            Mail::to($leaveRequest->employee->user->email)->send(new LeaveRequestRejected($leaveRequest));

            // Send notification
            $notificationMessage = "Leave request rejected.";
            $employeeSubscriptions = DB::table('push_subscriptions')
                ->where('user_id', $leaveRequest->employee->user_id)
                ->pluck('subscription_id')
                ->toArray();

            $this->sendOneSignalNotification($notificationMessage, $employeeSubscriptions, 'rejected');

            return redirect()->route('leave_requests.index')
                ->with('success', 'Leave request rejected successfully.');
        } catch (\Exception $e) {
            return redirect()->route('leave_requests.index')
                ->with('error', 'Error rejecting leave request: ' . $e->getMessage());
        }
    }

    protected function sendOneSignalNotification($message, array $subscriptionIds, $status)
    {
        try {
            if (empty($subscriptionIds)) {
                Log::warning('No subscriptions found.');
                return;
            }

            $appUrl = config('app.url');
            $route = $status === 'approved' ? 'leave_requests.show' : 'leave_requests.index';
            $notificationUrl = "{$appUrl}/{$route}";

            foreach ($subscriptionIds as $subscriptionId) {
                $response = OneSignal::sendNotificationToUser(
                    $message,
                    $subscriptionId,
                    null,
                    ["notificationUrl" => $notificationUrl]
                );

                if ($response->getStatusCode() !== 200) {
                    Log::error("Failed to send notification to subscription ID: $subscriptionId");
                }
            }
        } catch (\Exception $e) {
            Log::error('Error sending OneSignal notification: ' . $e->getMessage());
        }
    }
}
