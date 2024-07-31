<?php

namespace App\Mail;

use App\Models\Employee;
use App\Models\SpecificRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SpecificRequestStatusUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $employee;
    public $specificRequest;

    /**
     * Create a new message instance.
     *
     * @param Employee $employee
     * @param SpecificRequest $specificRequest
     * @return void
     */
    public function __construct(Employee $employee, SpecificRequest $specificRequest)
    {
        $this->employee = $employee;
        $this->specificRequest = $specificRequest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Mise à jour de statut de demande spécifique')
            ->markdown('emails.specific-request-status-updated');
    }
}

