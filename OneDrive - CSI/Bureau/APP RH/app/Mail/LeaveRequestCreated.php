<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\LeaveRequest;

class LeaveRequestCreated extends Mailable
{
use Queueable, SerializesModels;

public $leaveRequest;

/**
* Create a new message instance.
*
* @return void
*/
public function __construct(LeaveRequest $leaveRequest)
{
$this->leaveRequest = $leaveRequest;
}

/**
* Build the message.
*
* @return $this
*/
public function build()
{
return $this->subject('Leave Request Submitted')
->markdown('emails.leave_request_created');
}
}
