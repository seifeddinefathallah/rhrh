<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DefaultBalance;

class DefaultBalancesSeeder extends Seeder
{
    public function run()
    {
        // Exemple d'ajout pour tous les employés
        foreach (\App\Models\Employee::all() as $employee) {
            DefaultBalance::updateOrCreate(
                ['employee_id' => $employee->id, 'period' => 'month'],
                ['sortie_balance' => 2.00, 'teletravail_days_balance' => 5.00]
            );
        }
    }
}
