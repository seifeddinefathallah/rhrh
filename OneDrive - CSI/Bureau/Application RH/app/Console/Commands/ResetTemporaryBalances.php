<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TemporaryBalance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ResetTemporaryBalances extends Command
{
    protected $signature = 'balances:reset';
    protected $description = 'Réinitialiser les soldes temporaires à zéro à la fin de chaque période';

    public function handle()
    {
        $now = Carbon::now();

        Log::info('ResetTemporaryBalances command started at ' . $now);

        try {
            // Réinitialiser les soldes temporaires en fonction de la période spécifiée
            $this->resetBalancesForPeriod($now);

            $this->info('Les soldes temporaires ont été réinitialisés.');
            Log::info('Les soldes temporaires ont été réinitialisés.');
        } catch (\Exception $e) {
            $this->error('Error resetting temporary balances: ' . $e->getMessage());
            Log::error('Error resetting temporary balances: ' . $e->getMessage());
        }
    }

    private function resetBalancesForPeriod(Carbon $now)
    {
        // Réinitialiser les soldes temporaires pour chaque période
        $periods = ['day', 'month', 'year'];

        foreach ($periods as $period) {
            Log::info("Resetting balances for period: $period");
            if ($period === 'day') {
                $this->resetDailyBalances($now);
            } elseif ($period === 'month') {
                $this->resetMonthlyBalances($now);
            } elseif ($period === 'year') {
                $this->resetYearlyBalances($now);
            }
        }
    }

    private function resetDailyBalances(Carbon $now)
    {
        Log::info('Resetting daily balances');
        TemporaryBalance::whereHas('periodDefinition', function($query) {
            $query->where('name', 'day');
        })->whereDate('end_date', '<=', $now->endOfDay())
            ->delete();
    }

    private function resetMonthlyBalances(Carbon $now)
    {
        Log::info('Resetting monthly balances');
        TemporaryBalance::whereHas('periodDefinition', function($query) {
            $query->where('name', 'month');
        })->whereDate('end_date', '<=', $now->endOfMonth())
            ->delete();
    }

    private function resetYearlyBalances(Carbon $now)
    {
        Log::info('Resetting yearly balances');
        TemporaryBalance::whereHas('periodDefinition', function($query) {
            $query->where('name', 'year');
        })->whereDate('end_date', '<=', $now->endOfYear())
            ->delete();
    }
}
