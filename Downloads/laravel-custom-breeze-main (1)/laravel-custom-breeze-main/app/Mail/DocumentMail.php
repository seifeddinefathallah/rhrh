<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Employee;
use App\Models\AdministrativeRequest;

class DocumentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $employee;
    public $request;
    public $pdf;

    public function __construct(Employee $employee, AdministrativeRequest $request, $pdf)
    {
        $this->employee = $employee;
        $this->request = $request;
        $this->pdf = $pdf;
    }

    public function build()
    {
        return $this->markdown('emails.document')
            ->subject('Demande administrative approuvée')
            ->attachData($this->pdf, 'document.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}

