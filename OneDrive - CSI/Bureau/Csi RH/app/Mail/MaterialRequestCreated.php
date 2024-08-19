<?php

namespace App\Mail;

use App\Models\MaterialRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MaterialRequestCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $materialRequest;

    /**
     * Create a new message instance.
     *
     * @param MaterialRequest $materialRequest
     */
    public function __construct(MaterialRequest $materialRequest)
    {
        $this->materialRequest = $materialRequest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Material Request Created')
            ->markdown('emails.material-request-created');
    }
}
