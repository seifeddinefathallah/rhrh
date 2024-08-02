<?php

namespace App\Mail;

use App\Models\InterventionRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InterventionRequestRejected extends Mailable
{
    use Queueable, SerializesModels;

    public $interventionRequest;

    public function __construct(InterventionRequest $interventionRequest)
    {
        $this->interventionRequest = $interventionRequest;
    }

    public function build()
    {
        return $this->markdown('emails.interventionRequestRejected')
            ->with([
                'interventionRequest' => $this->interventionRequest,
            ]);
    }
}


