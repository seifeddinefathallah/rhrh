<?php

namespace App\Http\Controllers;

use App\Models\SupplyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Mail\SupplyRequestCreated;
use Illuminate\Support\Facades\Mail;
use App\Mail\SupplyRequestStatusUpdated;
use Berkayk\OneSignal\OneSignalClient;
use Berkayk\OneSignal\OneSignalFacade as OneSignal;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class SupplyRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $requests = SupplyRequest::all();
        $approvedCount = SupplyRequest::where('status', 'approved')->count();
        $pendingCount = SupplyRequest::where('status', 'pending')->count();
        $rejectedCount = SupplyRequest::where('status', 'rejected')->count();

        return view('supply_requests.index', compact('requests', 'approvedCount', 'pendingCount', 'rejectedCount'));
    }

    public function create()
    {
        return view('supply_requests.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'item_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->route('supply_requests.create')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Optionnel : Vous pouvez vérifier ici si l'utilisateur a un employé associé
            $employeeId = Auth::user()->employee->id;

            // Créez une nouvelle demande de fournitures
            $supplyRequest = SupplyRequest::create([
                'employee_id' => $employeeId, // Assurez-vous que ce champ est défini et valide
                'item_name' => $request->input('item_name'),
                'quantity' => $request->input('quantity'),
            ]);
            Mail::to($supplyRequest->employee->email_professionnel)
                ->send(new SupplyRequestCreated($supplyRequest));
            $employeeSubscriptions = DB::table('push_subscriptions')
                ->where('user_id', Auth::id()) // or $employeeId if your subscription IDs are linked to employees
                ->pluck('subscription_id')
                ->toArray();

            // Send OneSignal notification
            $this->sendOneSignalNotification_(
                "New Supply Request Created: {$supplyRequest->item_name}",
                $employeeSubscriptions,
                'created'
            );
            return redirect()->route('supply_requests.index')
                ->with('success', 'Supply request created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('supply_requests.create')
                ->with('error', 'Une erreur est survenue lors de la création de la demande: ' . $e->getMessage());
        }
    }

    public function show(SupplyRequest $supplyRequest)
    {
        return view('supply_requests.show', compact('supplyRequest'));
    }

    public function edit(SupplyRequest $supplyRequest)
    {
        return view('supply_requests.edit', compact('supplyRequest'));
    }

    public function update(Request $request, SupplyRequest $supplyRequest)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'quantity' => 'required|integer',
        ]);

        $supplyRequest->update($request->all());

        return redirect()->route('supply_requests.index')
            ->with('success', 'Supply request updated successfully.');
    }

    public function destroy(SupplyRequest $supplyRequest)
    {
        $supplyRequest->delete();

        return redirect()->route('supply_requests.index')
            ->with('success', 'Supply request deleted successfully.');
    }
    public function approve(SupplyRequest $supplyRequest)
    {
        $supplyRequest->update(['status' => 'approved']);
        Mail::to($supplyRequest->employee->email_professionnel)
            ->send(new SupplyRequestStatusUpdated($supplyRequest));
        $employeeSubscriptions = DB::table('push_subscriptions')
            ->where('user_id', $supplyRequest->employee->user_id)
            ->pluck('subscription_id')
            ->toArray();

        // Send OneSignal notification
        $this->sendOneSignalNotification_(
            "Supply Request Approved: {$supplyRequest->item_name}",
            $employeeSubscriptions,
            'approved'
        );
        return redirect()->route('supply_requests.index')
            ->with('success', 'Supply request approved successfully.');
    }

    public function reject(SupplyRequest $supplyRequest)
    {
        $supplyRequest->update(['status' => 'rejected']);
        Mail::to($supplyRequest->employee->email_professionnel)
            ->send(new SupplyRequestStatusUpdated($supplyRequest));
        $employeeSubscriptions = DB::table('push_subscriptions')
            ->where('user_id', $supplyRequest->employee->user_id)
            ->pluck('subscription_id')
            ->toArray();

        // Send OneSignal notification
        $this->sendOneSignalNotification_(
            "Supply Request Rejected: {$supplyRequest->item_name}",
            $employeeSubscriptions,
            'rejected'
        );
        return redirect()->route('supply_requests.index')
            ->with('success', 'Supply request rejected successfully.');
    }
    public function filterByStatus($status)
    {
        if (!in_array($status, ['approved', 'pending', 'rejected'])) {
            return redirect()->route('supply_requests.index')->with('error', 'Invalid status.');
        }

        $requests = SupplyRequest::where('status', $status)->get();

        $approvedCount = SupplyRequest::where('status', 'approved')->count();
        $pendingCount = SupplyRequest::where('status', 'pending')->count();
        $rejectedCount = SupplyRequest::where('status', 'rejected')->count();

        return view('supply_requests.index', compact('requests', 'approvedCount', 'pendingCount', 'rejectedCount'));
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
            $route = $status === 'approved' ? 'supply_requests.status' : 'supply_requests.status'; // Replace with actual route names
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

