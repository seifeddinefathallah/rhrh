<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PeriodDefinition;

class PeriodDefinitionsSeeder extends Seeder
{
    public function run()
    {
        PeriodDefinition::create(['name' => 'day', 'days' => 1]);
        PeriodDefinition::create(['name' => 'month', 'days' => 30]); // Approximate month length
        PeriodDefinition::create(['name' => 'year', 'days' => 365]); // Approximate year length
        // Add more period definitions as needed
    }
}
