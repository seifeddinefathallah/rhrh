<?php

namespace App\Notifications;

use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EventUpdatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Mise à jour de l\'événement : ' . $this->event->title)
            ->greeting('Bonjour ' . $notifiable->name)
            ->line('L\'événement auquel vous êtes invité a été mis à jour.')
            ->line('Nouveau Titre : ' . $this->event->title)
            ->line('Nouvelle Date de début : ' . \Carbon\Carbon::parse($this->event->start_time)->format('d M Y H:i'))
            ->line('Nouvelle Date de fin : ' . \Carbon\Carbon::parse($this->event->end_time)->format('d M Y H:i'))
            ->line('Nouveau Lieu : ' . $this->event->location)
            ->action('Voir l\'événement', url(route('events.show', $this->event->id)))
            ->line('Merci de prendre en compte ces changements.');
    }

    public function toArray($notifiable)
    {
        return [
            'event_id' => $this->event->id,
            'title' => $this->event->title,
        ];
    }
}
