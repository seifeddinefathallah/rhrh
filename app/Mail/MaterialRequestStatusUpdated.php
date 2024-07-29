<?php

namespace App\Mail;

use App\Models\MaterialRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MaterialRequestStatusUpdated extends Mailable
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
        return $this->subject('Material Request Status Updated')
            ->markdown('emails.material-request-status-updated');
    }
}
