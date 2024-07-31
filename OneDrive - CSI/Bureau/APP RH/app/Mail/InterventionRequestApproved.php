<?php

namespace App\Mail;

use App\Models\InterventionRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InterventionRequestApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $interventionRequest;

    public function __construct(InterventionRequest $interventionRequest)
    {
        $this->interventionRequest = $interventionRequest;
    }

    public function build()
    {
        return $this->markdown('emails.interventionRequestApproved')
            ->with([
                'interventionRequest' => $this->interventionRequest,
            ]);
    }
}


