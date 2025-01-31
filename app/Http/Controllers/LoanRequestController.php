<?php

namespace App\Http\Controllers;

use App\Models\LoanRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\LoanRequestNotification;
use App\Notifications\LoanRequestUpdateNotification;
use App\Mail\LoanRequestStatusUpdated;
use Berkayk\OneSignal\OneSignalFacade as OneSignal;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Facades\Mail;

class LoanRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        // Retrieve all loan requests
        $loanRequests = LoanRequest::all();
        $approvedCount = LoanRequest::where('status', 'Approuvé')->count();

        // Retrieve count of pending requests for each type
        $pendingByType = LoanRequest::where('status', 'En attente')
            ->select('type', \DB::raw('count(*) as total'))
            ->groupBy('type')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->type => $item->total];
            });

        // Return the view with the retrieved loan requests
        return view('loan_requests.index', compact('loanRequests', 'approvedCount', 'pendingByType'));
    }
    public function byType($type)
    {
        // Validate type if necessary
        $types = ['Prêt', 'Avances']; // Add other types as needed
        if (!in_array($type, $types)) {
            return redirect()->route('loan_requests.index')->with('error', 'Type de demande invalide.');
        }

        // Retrieve pending loan requests by type
        $loanRequests = LoanRequest::where('status', 'En attente')
            ->where('type', $type)
            ->get();

        return view('loan_requests.pending_by_type', compact('loanRequests', 'type'));
    }


    public function create()
    {
        return view('loan_requests.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:Prêt,Avances',
            'amount' => 'required|numeric|min:0',
            'comments'=> 'required'
        ]);

        $employee = Auth::user()->employee;
        // Determine currency based on employee's location
        $currency = $employee->country === 'TN' ? 'TND' : 'EUR';

        $loanRequest = LoanRequest::create([
            'type' => $request->type,
            'amount' => $request->amount,
            'currency' => $currency,
            'status' => 'En attente',
            'comments'=> $request->comments,
            'user_id' => Auth::id(),
            'employee_id' => $employee->id,
        ]);

        // Notify approvers
        // Notification::send(User::role(['DG', 'FINANCE'])->get(), new LoanRequestNotification($loanRequest));
        $notificationMessage = "Une nouvelle demande de prêt a été soumise.";
        $this->sendOneSignalNotification($notificationMessage, $loanRequest->employee->user_id);

        return redirect()->route('loan_requests.index')->with('success', 'Demande soumise avec succès.');
    }

    public function show($id)
    {
        $loanRequest = LoanRequest::findOrFail($id);
        // You can add authorization logic here if needed
        return view('loan_requests.show', compact('loanRequest'));
    }

    private function sendOneSignalNotification($message, $userId)
    {
        $subscriptionIds = DB::table('push_subscriptions')
            ->where('user_id', $userId)
            ->pluck('subscription_id')
            ->toArray();

        if (empty($subscriptionIds)) {
            return;
        }

        $notification = [
            'contents' => ['en' => $message],
            'include_player_ids' => $subscriptionIds,
        ];

        try {
            OneSignal::sendNotificationCustom($notification);
        } catch (\Exception $e) {
            \Log::error('Error sending OneSignal notification: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $loanRequest = LoanRequest::findOrFail($id);
        // You can add authorization logic here if needed
        return view('loan_requests.edit', compact('loanRequest'));
    }

    public function update(Request $request, $id)
    {
        $loanRequest = LoanRequest::findOrFail($id);

        $request->validate([
            'type' => 'required|in:Prêt,Avances',
            'amount' => 'required|numeric|min:0'
        ]);

        // Update loan request
        $loanRequest->type = $request->type;
        $loanRequest->amount = $request->amount;
        $loanRequest->comments = $request->comments;
        $loanRequest->save();

        return redirect()->route('loan_requests.index')->with('success', 'Demande mise à jour avec succès.');
    }

    public function approve(LoanRequest $loanRequest)
    {
        // Eager load employee relationship
        $loanRequest->load('employee');

        // Check if employee is not null
        if ($loanRequest->employee) {
            $loanRequest->update(['status' => 'Approuvé']);

            // Send email notification to the requester
            Mail::to($loanRequest->employee->email_professionnel)
                ->send(new LoanRequestStatusUpdated($loanRequest));

            $notificationMessage = "Votre demande de prêt a été approuvée.";
            $this->sendOneSignalNotification($notificationMessage, $loanRequest->employee->user_id);

            return redirect()->route('loan_requests.index')
                ->with('success', 'La demande a été approuvée.');
        } else {
            return redirect()->route('loan_requests.index')
                ->with('error', 'L\'employé associé à cette demande n\'a pas été trouvé.');
        }
    }

    public function reject(LoanRequest $loanRequest)
    {
        // Eager load employee relationship
        $loanRequest->load('employee');

        // Check if employee is not null
        if ($loanRequest->employee) {
            $loanRequest->update(['status' => 'Rejeté']);

            // Send email notification to the requester
            Mail::to($loanRequest->employee->email_professionnel)
                ->send(new LoanRequestStatusUpdated($loanRequest));

            $notificationMessage = "Votre demande de prêt a été rejetée.";
            $this->sendOneSignalNotification($notificationMessage, $loanRequest->employee->user_id);

            return redirect()->route('loan_requests.index')
                ->with('success', 'La demande a été rejetée.');
        } else {
            return redirect()->route('loan_requests.index')
                ->with('error', 'L\'employé associé à cette demande n\'a pas été trouvé.');
        }
    }

    public function destroy($id)
    {
        $loanRequest = LoanRequest::findOrFail($id);
        $loanRequest->delete();

        return redirect()->route('loan_requests.index')->with('success', 'Demande supprimée avec succès.');
    }

    /*public function pendingRequestsByType()
    {
        // Count pending requests grouped by type
        $pendingByType = LoanRequest::where('status', 'En attente')
            ->select('type', \DB::raw('count(*) as total'))
            ->groupBy('type')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->type => $item->total];
            });

        return view('loan_requests.pending_by_type', compact('pendingByType'));
    }*/
}
