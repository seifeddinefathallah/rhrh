<?php

namespace App\Http\Controllers;

use App\Models\LoanRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\LoanRequestNotification;
use App\Notifications\LoanRequestUpdateNotification;
Use App\Http\Controllers\LoanRequestStatusUpdated;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Facades\Mail;

class LoanRequestController extends Controller
{
    public function index()
    {
        // Retrieve all loan requests
        $loanRequests = LoanRequest::all();

        // Return the view with the retrieved loan requests
        return view('loan_requests.index', compact('loanRequests'));
    }

    public function create()
    {
        return view('loan_requests.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:Prêt,Avances',
            'amount' => 'required|numeric|min:0'
        ]);

        $employee = Auth::user()->employee;
        // Determine currency based on employee's location
        $currency = $employee->country === 'TN' ? 'TND' : 'EUR';

        $loanRequest = LoanRequest::create([
            'type' => $request->type,
            'amount' => $request->amount,
            'currency' => $currency,
            'status' => 'En attente',
            'user_id' => Auth::id(), // Add this line to include the user_id
             'employee_id' => $employee->id,
        ]);

        // Notify approvers
        // Notification::send(User::role(['DG', 'FINANCE'])->get(), new LoanRequestNotification($loanRequest));

        return redirect()->route('loan_requests.index')->with('success', 'Demande soumise avec succès.');
    }


    public function show($id)
    {
        $loanRequest = LoanRequest::findOrFail($id);
        // You can add authorization logic here if needed
        return view('loan_requests.show', compact('loanRequest'));
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
            $loanRequest->update(['status' => 'approved']);
    
            // Envoyer une notification par e-mail au demandeur
            Mail::to($loanRequest->employee->email_professionnel)
                ->send(new LoanRequestStatusUpdated($loanRequest));
    
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
            $loanRequest->update(['status' => 'rejected']);
    
            // Envoyer une notification par e-mail au demandeur
            Mail::to($loanRequest->employee->email_professionnel)
                ->send(new LoanRequestStatusUpdated($loanRequest));
    
            return redirect()->route('loan_requests.index')
                ->with('success', 'La demande a été rejetée.');
        } else {
            return redirect()->route('loan_requests.index')
                ->with('error', 'L\'employé associé à cette demande n\'a pas été trouvé.');
        }
    }
    
    public function updateStatus(Request $request, LoanRequest $loanRequest)
    {
        // Validez les données reçues du formulaire, si nécessaire
        // ...

        // Appelez la route nommée pour mettre à jour le statut via ApprovalHistoryController@update
        $response = Redirect::route('loan_requests.update_status', ['loanRequest' => $loanRequest->id])
            ->withInput($request->all());

        return $response;
    }

    public function destroy($id)
    {
        $loanRequest = LoanRequest::findOrFail($id);
        $loanRequest->delete();

        return redirect()->route('loan_requests.index')->with('success', 'Demande supprimée avec succès.');
    }
}
