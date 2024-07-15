<?php

namespace App\Mail;

use App\Models\Employee;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class EmployeeCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $employee;
    public $password;

    public function __construct(Employee $employee, $password)
    {
        $this->employee = $employee;
        $this->password = $password;
    }

    public function build()
    {
        $this->employee->load('poste','departement.entites');

        return $this->markdown('emails.employee_created')
            ->subject('Welcome to Csi')
            ->with([
                'employee' => $this->employee,
                'password' => $this->password,
            ]);
    }
}
