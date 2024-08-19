<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TemporaryBalance;
use App\Models\Employee;
use Carbon\Carbon;
use App\Models\PeriodDefinition;

class TemporaryBalancesSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();
        $startDate = $now->startOfMonth()->toDateString();
        $endDate = $now->endOfMonth()->toDateString();
        $periodDefinition = PeriodDefinition::where('name', 'month')->first();

        $employees = Employee::all();

        foreach ($employees as $employee) {
            TemporaryBalance::create([
                'employee_id' => $employee->id,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'sortie_hours' => 4.00,
                'teletravail_days' => 8.00,
                'period_definition_id' => $periodDefinition->id,
            ]);
        }
    }
}

