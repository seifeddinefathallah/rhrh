<?php

namespace App\Mail;

use App\Models\InterventionRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InterventionRequestCreated extends Mailable
{
use Queueable, SerializesModels;

public $interventionRequest;

public function __construct(InterventionRequest $interventionRequest)
{
$this->interventionRequest = $interventionRequest;
}

public function build()
{
return $this->markdown('emails.interventionRequestCreated')
->with([
'interventionRequest' => $this->interventionRequest,
]);
}
}
