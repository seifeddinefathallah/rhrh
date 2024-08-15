<?php

namespace App\Notifications;

use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class EventInvitationNotification extends Notification
{
    use Queueable;

    public $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];  // Vous pouvez ajouter 'database' ou d'autres canaux ici
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Invitation à un événement')
            ->greeting('Bonjour ' . $notifiable->name)
            ->line('Vous êtes invité à l\'événement suivant :')
            ->line('Titre : ' . $this->event->title)
            ->line('Date : ' . \Carbon\Carbon::parse($this->event->start_time)->format('d M Y'))
            ->line('Lieu : ' . $this->event->location)
            ->action('Voir l\'événement', url(route('events.show', $this->event->id)))
            ->line('Merci de votre participation !');
    }

    // Vous pouvez également ajouter d'autres méthodes pour les autres canaux, comme toDatabase, etc.
}


