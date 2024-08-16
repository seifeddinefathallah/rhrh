<?php

namespace App\Http\Controllers;

use App\Models\MaterialRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\MaterialRequestCreated;
use Illuminate\Support\Facades\Mail;
use App\Mail\MaterialRequestStatusUpdated;
use Berkayk\OneSignal\OneSignalClient;
use Berkayk\OneSignal\OneSignalFacade as OneSignal;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class MaterialRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $requests = MaterialRequest::all();
        $approvedCount = MaterialRequest::where('status', 'approved')->count();
        $rejectedCount = MaterialRequest::where('status', 'rejected')->count();
        $pendingCount = MaterialRequest::where('status', 'pending')->count();
        return view('material_requests.index', compact('requests', 'approvedCount', 'rejectedCount', 'pendingCount'));
    }

    public function create()
    {
        return view('material_requests.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'material_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer',
        ]);
        $employeeId = Auth::user()->employee->id;
        $materialRequest = MaterialRequest::create([
            'employee_id' => $employeeId,
            'material_name' => $request->material_name,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'status' => 'pending',
        ]);
        Mail::to($materialRequest->employee->email_professionnel)
            ->send(new MaterialRequestCreated($materialRequest));
        $employeeSubscriptions = DB::table('push_subscriptions')
            ->where('user_id', Auth::id()) // or $employeeId if your subscription IDs are linked to employees
            ->pluck('subscription_id')
            ->toArray();

        // Send OneSignal notification
        $this->sendOneSignalNotification_(
            "New Material Request Created: {$materialRequest->material_name}",
            $employeeSubscriptions,
            'created'
        );

        return redirect()->route('material_requests.index')->with('success', 'Request created successfully.');
    }

    public function show(MaterialRequest $materialRequest)
    {
        return view('material_requests.show', compact('materialRequest'));
    }

    public function edit(MaterialRequest $materialRequest)
    {
        return view('material_requests.edit', compact('materialRequest'));
    }

    public function update(Request $request, MaterialRequest $materialRequest)
    {
        $request->validate([
            'material_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer',
        ]);

        $materialRequest->update($request->all());


        return redirect()->route('material_requests.index')->with('success', 'Request updated successfully.');
    }

    public function destroy(MaterialRequest $materialRequest)
    {
        $materialRequest->delete();
        return redirect()->route('material_requests.index')->with('success', 'Request deleted successfully.');
    }

    public function approve(MaterialRequest $materialRequest)
    {
        $materialRequest->update(['status' => 'approved']);
        Mail::to($materialRequest->employee->email_professionnel)
            ->send(new MaterialRequestStatusUpdated($materialRequest));
        $employeeSubscriptions = DB::table('push_subscriptions')
            ->where('user_id', $materialRequest->employee->user_id)
            ->pluck('subscription_id')
            ->toArray();

        // Send OneSignal notification
        $this->sendOneSignalNotification_(
            "Material Request Approved: {$materialRequest->material_name}",
            $employeeSubscriptions,
            'approved'
        );
        return redirect()->route('material_requests.index')->with('success', 'Request approved successfully.');
    }

    public function reject(MaterialRequest $materialRequest)
    {
        $materialRequest->update(['status' => 'rejected']);
        Mail::to($materialRequest->employee->email_professionnel)
            ->send(new MaterialRequestStatusUpdated($materialRequest));
        $employeeSubscriptions = DB::table('push_subscriptions')
            ->where('user_id', $materialRequest->employee->user_id)
            ->pluck('subscription_id')
            ->toArray();

        // Send OneSignal notification
        $this->sendOneSignalNotification_(
            "Material Request Rejected: {$materialRequest->material_name}",
            $employeeSubscriptions,
            'rejected'
        );
        return redirect()->route('material_requests.index')->with('success', 'Request rejected successfully.');
    }

    protected function sendOneSignalNotification_($message, array $subscriptionIds, $status)
    {
        try {
            if (empty($subscriptionIds)) {
                Log::warning('No subscriptions found.');
                return;
            }

            $appUrl = config('app.url'); // Fetch the APP_URL from .env

            // Set route based on status
            $route = $status === 'approved' ? 'material_requests.status' : 'material_requests.status'; // Replace with actual route names
            $notificationUrl = "{$appUrl}/{$route}"; // Construct the full URL

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

