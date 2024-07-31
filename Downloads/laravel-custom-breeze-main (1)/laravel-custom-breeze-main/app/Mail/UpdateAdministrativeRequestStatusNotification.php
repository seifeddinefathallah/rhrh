<?php
namespace App\Mail;

use App\Models\Employee;
use App\Models\AdministrativeRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UpdateAdministrativeRequestStatusNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $employee;
    public $administrativeRequest;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Employee $employee, AdministrativeRequest $administrativeRequest)
    {
        $this->employee = $employee;
        $this->administrativeRequest = $administrativeRequest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Mise à jour de statut de demande administrative')
            ->markdown('emails.update_administrative_request_status_notification');
    }
}
