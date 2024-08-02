<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Event;

class EmployeeNotifications extends Component
{
    protected $listeners = ['notifyEmployee'];

    public function notifyEmployee($message)
    {
        $this->dispatchBrowserEvent('employeeNotification', ['message' => $message]);
        \Log::info('Employee notification emitted with message: ' . $message);
    }

    public function mount()
    {
        Event::listen('EmployeeNotification', function ($message) {
            $this->notifyEmployee($message);
        });
    }

    public function render()
    {
        return view('livewire.employee-notifications');
    }
}



