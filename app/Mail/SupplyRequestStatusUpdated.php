<?php

namespace App\Mail;

use App\Models\SupplyRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SupplyRequestStatusUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $supplyRequest;

    /**
     * Create a new message instance.
     *
     * @param SupplyRequest $supplyRequest
     */
    public function __construct(SupplyRequest $supplyRequest)
    {
        $this->supplyRequest = $supplyRequest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Supply Request Status Updated')
            ->markdown('emails.supply-request-status-updated');
    }
}
