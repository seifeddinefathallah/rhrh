<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EmployeeNotification
{
    use Dispatchable, SerializesModels;

    public $message;

    public function __construct($message)
    {
        $this->message = $message;
    }
}

