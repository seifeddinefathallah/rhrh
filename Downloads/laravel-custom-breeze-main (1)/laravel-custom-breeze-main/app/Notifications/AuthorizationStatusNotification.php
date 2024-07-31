<?php

namespace App\Notifications;

use App\Models\AuthorizationRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class AuthorizationStatusNotification extends Notification
{
    use Queueable;

    protected $authorizationRequest;

    public function __construct(AuthorizationRequest $authorizationRequest)
    {
        $this->authorizationRequest = $authorizationRequest;
    }

    public function via($notifiable)
    {
        return ['mail']; // Définissez ici les canaux supplémentaires si nécessaire (ex: ['mail', 'database'])
    }

    public function toMail($notifiable)
    {
        $url = url('/authorizations/' . $this->authorizationRequest->id);

        return (new MailMessage)
            ->subject('Authorization Request Status Update')
            ->line('The status of your authorization request has been updated.')
            ->action('View Authorization Request', $url)
            ->line('Thank you for using our application!');
    }

    // Définissez d'autres méthodes pour les autres canaux si nécessaire (ex: toDatabase, toBroadcast, etc.)
}
