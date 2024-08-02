<?php

namespace App\Mail;

use App\Models\Employee;
use App\Models\SpecificRequest; // Import your model
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SpecificRequestCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $employee;
    public $specificRequest;

    /**
     * Create a new message instance.
     *
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
     * @return \Illuminate\Mail\Mailable
     */
    public function build()
    {
        return $this->markdown('emails.specific-request-created')
            ->subject('Nouvelle Demande Spécifique Créée');
    }

}



