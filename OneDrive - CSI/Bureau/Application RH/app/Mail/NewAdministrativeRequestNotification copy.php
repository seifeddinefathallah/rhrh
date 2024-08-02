<?php
// app/Mail/NewAdministrativeRequestNotification.php

namespace App\Mail;

use App\Models\Employee;
use App\Models\AdministrativeRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
class NewAdministrativeRequestNotification extends Mailable
{
use Queueable, SerializesModels;

public $employee;
public $user;
public $administrativeRequest;
public $request;

/*public function __construct(Employee $employee, AdministrativeRequest $request)
{
$this->employee = $employee;
$this->request = $request;
}*/
    public function __construct(User $user, AdministrativeRequest $administrativeRequest)
    {
        $this->user = $user;
        $this->administrativeRequest = $administrativeRequest;
    }
public function build()
{
return $this->markdown('emails.new_administrative_request_notification')
->subject('Nouvelle demande administrative');
}
}
