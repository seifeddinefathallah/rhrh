<?php

namespace App\Http\Controllers;

use App\Models\LoanRequest;
use App\Models\ApprovalHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\LoanRequestUpdateNotification;

class ApprovalHistoryController extends Controller
{
    /**
     * Update the approval status of a loan request.
     *
     * @param Request $request
     * @param LoanRequest $loanRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, LoanRequest $loanRequest)
    {
        $request->validate([
            'status' => 'required|in:Approuvé,Rejeté',
            'comments' => 'nullable|string'
        ]);

        // Créer un historique d'approbation
        $approval = ApprovalHistory::create([
            'loan_request_id' => $loanRequest->id,
            'user_id' => Auth::id(),
            'status' => $request->status,
            'comments' => $request->comments
        ]);

        // Mettre à jour le statut de la demande de prêt
        $loanRequest->status = $request->status;
        $loanRequest->save(); // Assurez-vous de sauvegarder les modifications

        // Notifier le demandeur
        Notification::send($loanRequest->user, new LoanRequestUpdateNotification($loanRequest));

        return redirect()->back()->with('success', 'Demande mise à jour avec succès.');
    }

}

