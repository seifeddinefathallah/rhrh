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
    public function update(Request $request, LoanRequest $loanRequest)
    {
        $request->validate([
            'status' => 'required|in:Approuvé,Rejeté',
            'comments' => 'nullable|string'
        ]);

        $approval = ApprovalHistory::create([
            'loan_request_id' => $loanRequest->id,
            'user_id' => Auth::id(),
            'status' => $request->status,
            'comments' => $request->comments
        ]);

        $loanRequest->status = $request->status;
        $loanRequest->save();

        // Notify requester
        Notification::send($loanRequest->user, new LoanRequestUpdateNotification($loanRequest));

        return redirect()->back()->with('success', 'Demande mise à jour avec succès.');
    }
}
