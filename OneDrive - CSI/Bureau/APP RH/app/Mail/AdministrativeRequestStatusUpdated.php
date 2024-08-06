<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\AdministrativeRequest;

class AdministrativeRequestStatusUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $request;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(AdministrativeRequest $request)
    {
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Mise à jour du statut de votre demande administrative')
                    ->markdown('emails.requests.status_updated')
                   /* ->with([
                        'employeeName' => $this->request->employee->prenom . ' ' . $this->request->employee->nom,
                        'requestType' => $this->request->type,
                        'requestStatus' => $this->request->status,
                    ])*/
                        ;
    }
}
