<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PendingRequestReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $request;
    public $type;

    /**
     * Create a new message instance.
     *
     * @param  $request
     * @param  $type
     * @return void
     */
    public function __construct($request, $type)
    {
        $this->request = $request;
        $this->type = $type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Pending Request Reminder')
            ->markdown('emails.pending_request_reminder')
            ->with([
                'request' => $this->request,
                'type' => $this->type,
            ]);
    }
}
