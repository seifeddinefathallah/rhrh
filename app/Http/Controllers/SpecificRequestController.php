<?php

namespace App\Http\Controllers;

use App\Mail\NewAdministrativeRequestNotification;
use App\Mail\SpecificRequestStatusUpdated;
use App\Models\MaterialRequest;
use App\Models\SpecificRequest;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\SpecificRequestCreated;
use Illuminate\Support\Facades\Mail;
use Berkayk\OneSignal\OneSignalClient;
use Berkayk\OneSignal\OneSignalFacade as OneSignal;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class SpecificRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $approvedCount = SpecificRequest::where('status', 'approved')->count();
        $rejectedCount = SpecificRequest::where('status', 'rejected')->count();
        $pendingCount = SpecificRequest::where('status', 'pending')->count();
        $requests = SpecificRequest::with('employee')->paginate(10);
        return view('specific_requests.index', compact('requests', 'approvedCount', 'rejectedCount', 'pendingCount'));
    }

    public function status($status)
    {
        $validStatuses = ['approved', 'rejected', 'pending'];
        if (!in_array($status, $validStatuses)) {
            abort(404); // Or handle the error as needed
        }

        $requests = SpecificRequest::where('status', $status)->paginate(10);

        $approvedCount = SpecificRequest::where('status', 'approved')->count();
        $rejectedCount = SpecificRequest::where('status', 'rejected')->count();
        $pendingCount = SpecificRequest::where('status', 'pending')->count();

        return view('specific_requests.index', compact('requests', 'approvedCount', 'rejectedCount', 'pendingCount'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('specific_requests.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'request_type' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $employeeId = Auth::user()->employee->id;
        $specificRequest = SpecificRequest::create([
            'employee_id' => $employeeId,
            'request_type' => $request->request_type,
            'description' => $request->description,
            'status' => 'pending',
        ]);
        $employee = Employee::find(Auth::user()->employee->id);

        if (!$employee) {
            return redirect()->back()->with('error', 'Employee not found.');
        }
        if (empty($employee->email_professionnel)) {
            return redirect()->back()->with('error', 'Employee email address is missing.');
        }
        // Send the email
        $user = Auth::user();

        // Send email notification for the creation of the request
        if ($user) {
            Mail::to($employee->email_professionnel)->send(new SpecificRequestCreated($employee, $specificRequest));
        }
        $employeeSubscriptions = DB::table('push_subscriptions')
            ->where('user_id', $employee->user_id)
            ->pluck('subscription_id')
            ->toArray();

        $this->sendOneSignalNotification(
            'A new specific request has been created.',
            $employeeSubscriptions,
            'pending'
        );
        return redirect()->route('specific_requests.index')->with('success', 'Specific request created successfully!');
    }

    public function show(SpecificRequest $specificRequest)
    {
        return view('specific_requests.show', compact('specificRequest'));
    }

    public function edit(SpecificRequest $specificRequest)
    {
        $employees = Employee::all();
        return view('specific_requests.edit', compact('specificRequest', 'employees'));
    }

    public function update(Request $request, SpecificRequest $specificRequest)
    {
        $request->validate([

            'request_type' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $specificRequest->update($request->all());

        return redirect()->route('specific_requests.index')->with('success', 'Specific request updated successfully!');
    }

    public function destroy(SpecificRequest $specificRequest)
    {
        $specificRequest->delete();
        return redirect()->route('specific_requests.index')->with('success', 'Specific request deleted successfully!');
    }
    public function approve(SpecificRequest $specificRequest)
    {
        $specificRequest->update(['status' => 'approved']);
        $employee = Employee::find(Auth::user()->employee->id);

        if (!$employee) {
            return redirect()->back()->with('error', 'Employee not found.');
        }
        if (empty($employee->email_professionnel)) {
            return redirect()->back()->with('error', 'Employee email address is missing.');
        }
        // Send the email
        $user = Auth::user();

        // Send email notification for the creation of the request
        if ($user) {
            Mail::to($employee->email_professionnel)->send(new SpecificRequestStatusUpdated($employee, $specificRequest));
        }
        $employeeSubscriptions = DB::table('push_subscriptions')
            ->where('user_id', $employee->user_id)
            ->pluck('subscription_id')
            ->toArray();

        $this->sendOneSignalNotification(
            'Your specific request has been approved.',
            $employeeSubscriptions,
            'approved'
        );
        return redirect()->route('specific_requests.index')->with('success', 'Specific request approved successfully.');
    }

    public function reject(SpecificRequest $specificRequest)
    {
        $specificRequest->update(['status' => 'rejected']);
        $employee = Employee::find(Auth::user()->employee->id);

        if (!$employee) {
            return redirect()->back()->with('error', 'Employee not found.');
        }
        if (empty($employee->email_professionnel)) {
            return redirect()->back()->with('error', 'Employee email address is missing.');
        }
        // Send the email
        $user = Auth::user();

        // Send email notification for the creation of the request
        if ($user) {
            Mail::to($employee->email_professionnel)->send(new SpecificRequestStatusUpdated($employee, $specificRequest));
        }
        $employeeSubscriptions = DB::table('push_subscriptions')
            ->where('user_id', $employee->user_id)
            ->pluck('subscription_id')
            ->toArray();

        $this->sendOneSignalNotification(
            'Your specific request has been rejected.',
            $employeeSubscriptions,
            'rejected'
        );
        return redirect()->route('specific_requests.index')->with('success', 'Specific request rejected successfully.');
    }

    protected function sendOneSignalNotification($message, array $subscriptionIds, $status)
    {
        try {
            if (empty($subscriptionIds)) {
                Log::warning('No subscriptions found.');
                return;
            }

            // Define the URL to which the user will be redirected when they click the notification
            $appUrl = config('app.url'); // Fetch the APP_URL from .env

            // Set route based on status
            $route = 'specific_requests.status';
            $notificationUrl = "{$appUrl}/{$route}/{$status}"; // Construct the full URL

            foreach ($subscriptionIds as $subscriptionId) {
                $response = OneSignal::sendNotificationToUser(
                    $message,
                    $subscriptionId,
                    $url = $notificationUrl // Add the URL parameter
                );

                Log::info('Notification sent successfully to subscription ID: ' . $subscriptionId, [
                    'response' => $response
                ]);
            }

        } catch (\Exception $e) {
            Log::error('Error sending notification: ' . $e->getMessage());
        }
    }
}

