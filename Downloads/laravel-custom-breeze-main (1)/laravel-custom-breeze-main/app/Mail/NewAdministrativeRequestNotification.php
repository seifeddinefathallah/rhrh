<?php
// app/Mail/NewAdministrativeRequestNotification.php

namespace App\Mail;

use App\Models\Employee;
use App\Models\AdministrativeRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewAdministrativeRequestNotification extends Mailable
{
use Queueable, SerializesModels;

public $employee;
public $request;

public function __construct(Employee $employee, AdministrativeRequest $request)
{
$this->employee = $employee;
$this->request = $request;
}

public function build()
{
return $this->markdown('emails.new_administrative_request_notification')
->subject('Nouvelle demande administrative');
}
}
