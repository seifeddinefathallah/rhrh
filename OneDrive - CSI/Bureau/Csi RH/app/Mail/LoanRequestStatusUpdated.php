<?php

namespace App\Mail;

use App\Models\LoanRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LoanRequestStatusUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $loanRequest;

    /**
     * Create a new message instance.
     *
     * @param LoanRequest $loanRequest
     */
    public function __construct(LoanRequest $loanRequest)
    {
        $this->loanRequest = $loanRequest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Loan Request Status Updated')
            ->markdown('emails.loan-request-status-updated');
    }
}
