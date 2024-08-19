<?php

namespace App\Listeners;

use App\Events\EmployeeNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyEmployee
{
    public function __construct()
    {
        //
    }

    public function handle(EmployeeNotification $event)
    {
        // Emit the event to Livewire
        \Livewire\Livewire::dispatch('employeeNotification', $event->message);
    }
}

