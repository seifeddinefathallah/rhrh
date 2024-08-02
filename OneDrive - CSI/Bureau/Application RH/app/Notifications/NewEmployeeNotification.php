<?php

namespace App\Notifications;

use App\Models\Employee;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewEmployeeNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $existingEmployee;
    protected $newEmployee;

    public function __construct(Employee $existingEmployee, Employee $newEmployee)
    {
        $this->existingEmployee = $existingEmployee;
        $this->newEmployee = $newEmployee;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Employee Notification')
            ->greeting('Hello ' . $this->existingEmployee->prenom . ' ' . $this->existingEmployee->nom . ',')
            ->line('A new employee has been added: ' . $this->newEmployee->prenom . ' ' . $this->newEmployee->nom . ',')
            ->line('They will be working as a '. $this->newEmployee->poste->titre.' in the '. $this->newEmployee->departement->nom. ' department')
            ->line('Please welcome them to the team!');
    }
}
