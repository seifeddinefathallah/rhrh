<?php

namespace App\Http\Controllers;

use App\Models\LoanRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\LoanRequestNotification;
use App\Models\User;
use App\Models\Employee;

class LoanRequestController extends Controller
{
    public function index()
    {

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


        // Determine currency based on employee's location
        if ($employee->country === 'TN') {
            $currency = 'TND';
        } else {
            $currency = 'EUR';
        }

        $loanRequest = LoanRequest::create([
            'type' => $request->type,
            'amount' => $request->amount,
            'currency' => $currency,
            'status' => 'En attente',
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
    public function approve(Request $request, LoanRequest $loanRequest)
    {
        // Logique d'approbation
        $loanRequest->update(['status' => 'approved']);

        // Envoyer une notification au demandeur
        $loanRequest->user->notify(new LoanRequestApproved($loanRequest));

        return redirect()->route('loan-requests.index')->with('success', 'La demande a été approuvée.');
    }

    public function reject(Request $request, LoanRequest $loanRequest)
    {
        // Logique de rejet
        $loanRequest->update(['status' => 'rejected']);

        // Envoyer une notification au demandeur
        $loanRequest->user->notify(new LoanRequestRejected($loanRequest));

        return redirect()->route('loan-requests.index')->with('success', 'La demande a été rejetée.');
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

