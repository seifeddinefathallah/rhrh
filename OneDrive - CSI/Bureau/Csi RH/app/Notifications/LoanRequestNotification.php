<?php

namespace App\Notifications;

use App\Models\LoanRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LoanRequestNotification extends Notification
{
    use Queueable;

    protected $loanRequest;

    public function __construct(LoanRequest $loanRequest)
    {
        $this->loanRequest = $loanRequest;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Une nouvelle demande de prêt ou avance a été soumise.')
            ->action('Voir la demande', url('/loan_requests/'.$this->loanRequest->id))
            ->line('Merci de vérifier la demande et d\'approuver ou rejeter.');
    }
}
