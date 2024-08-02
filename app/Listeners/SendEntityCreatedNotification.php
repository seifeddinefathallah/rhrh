<?php

namespace App\Listeners;

use App\Events\EntityCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\EntityCreatedNotification;

class SendEntityCreatedNotification
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\EntityCreated  $event
     * @return void
     */
    public function handle(EntityCreated $event)
    {
        Notification::send(auth()->user(), new EntityCreatedNotification($event->entite));
    }
}

