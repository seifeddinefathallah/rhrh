<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\Employee;

class MessageSent
{
    use Dispatchable, InteractsWithSockets;

    public $employee;

    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    public function broadcastOn()
    {
        return new Channel('employees.' . $this->employee->id);
    }

    public function broadcastWith()
    {
        return [
            'name' => $this->employee->nom,
            'position' => $this->employee->poste->titre,
            'department' => $this->employee->departement->nom,
        ];
    }
}

