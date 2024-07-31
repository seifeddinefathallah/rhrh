<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\LoginNotification;
use Illuminate\Support\Facades\Auth;
class SendLoginNotification
{
    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $user = $event->user;
        $user->notify(new LoginNotification());
        $user->update(['onesignal_player_id' => Auth::user()->onesignal_player_id]);

    }
}
