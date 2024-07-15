<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeesTableSeeder extends Seeder
{
    public function run()
    {
        Employee::query()->update([
            'sortie_balance' => 2.00,
            'teletravail_days_balance' => 5,
        ]);
    }
}
