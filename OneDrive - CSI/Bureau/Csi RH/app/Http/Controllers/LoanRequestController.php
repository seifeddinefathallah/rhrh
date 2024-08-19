<?php

namespace App\Http\Controllers;

use App\Models\LoanRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\LoanRequestStatusUpdated;

class LoanRequestController extends Controller
{
    public function index()
    {
        $loanRequests = LoanRequest::all();
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
            'amount' => 'required|numeric|min:0',
             'comments' => 'nullable|string'
        ]);

        $employee = Auth::user()->employee;
        $currency = $employee->country === 'TN' ? 'TND' : 'EUR';

        $loanRequest = LoanRequest::create([
            'type' => $request->type,
            'amount' => $request->amount,
            'currency' => $currency,
            'comments' => $request->comments,
            'status' => 'En attente',
            'user_id' => Auth::id(),
            'employee_id' => $employee->id,
        ]);

        return redirect()->route('loan_requests.index')->with('success', 'Demande soumise avec succès.');
    }

    public function show($id)
    {
        $loanRequest = LoanRequest::findOrFail($id);
        return view('loan_requests.show', compact('loanRequest'));
    }

    public function edit($id)
    {
        $loanRequest = LoanRequest::findOrFail($id);
        return view('loan_requests.edit', compact('loanRequest'));
    }

    public function update(Request $request, $id)
    {
        $loanRequest = LoanRequest::findOrFail($id);

        $request->validate([
            'type' => 'required|in:Prêt,Avances',
            'amount' => 'required|numeric|min:0'
        ]);

        $loanRequest->type = $request->type;
        $loanRequest->amount = $request->amount;
        $loanRequest->comments = $request->comments;
        $loanRequest->save();

        return redirect()->route('loan_requests.index')->with('success', 'Demande mise à jour avec succès.');
    }

    public function approve($id)
    {
        $loanRequest = LoanRequest::findOrFail($id);
        $loanRequest->update(['status' => 'Approuvé']); // Utilisez la valeur exacte de l'énumération
    
        if ($loanRequest->employee && !empty($loanRequest->employee->email_professionnel)) {
            Mail::to($loanRequest->employee->email_professionnel)
                ->send(new LoanRequestStatusUpdated($loanRequest));
            Log::info('E-mail envoyé à : ' . $loanRequest->employee->email_professionnel);
        } else {
            Log::warning('L\'employé n\'a pas d\'adresse e-mail valide.');
        }
    
        return redirect()->route('loan_requests.index')
            ->with('success', 'La demande a été approuvée.');
    }
    

    public function reject($id)
    {
        $loanRequest = LoanRequest::findOrFail($id);
        $loanRequest->update(['status' => 'Rejeté']); // Utilisez la valeur exacte de l'énumération
    
        if ($loanRequest->employee && !empty($loanRequest->employee->email_professionnel)) {
            Mail::to($loanRequest->employee->email_professionnel)
                ->send(new LoanRequestStatusUpdated($loanRequest));
            Log::info('E-mail envoyé à : ' . $loanRequest->employee->email_professionnel);
        } else {
            Log::warning('L\'employé n\'a pas d\'adresse e-mail valide.');
        }
    
        return redirect()->route('loan_requests.index')
            ->with('success', 'La demande a été rejetée.');
    }
    

    public function destroy($id)
    {
        $loanRequest = LoanRequest::findOrFail($id);
        $loanRequest->delete();

        return redirect()->route('loan_requests.index')->with('success', 'Demande supprimée avec succès.');
    }
}
