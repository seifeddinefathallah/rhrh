<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TemporaryBalance;
use Carbon\Carbon;

class ResetTemporaryBalances extends Command
{
    protected $signature = 'balances:reset';
    protected $description = 'Réinitialiser les soldes temporaires à zéro à la fin de chaque période';

    public function handle()
    {
        $now = Carbon::now();

        // Réinitialiser les soldes temporaires en fonction de la période spécifiée
        $this->resetBalancesForPeriod($now);

        $this->info('Les soldes temporaires ont été réinitialisés.');
    }

    private function resetBalancesForPeriod(Carbon $now)
    {
        // Réinitialiser les soldes temporaires pour chaque période
        $periods = ['day', 'month', 'year'];

        foreach ($periods as $period) {
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
        TemporaryBalance::where('period', 'day')
            ->whereDate('end_date', '<=', $now->endOfDay())
            ->delete();
    }

    private function resetMonthlyBalances(Carbon $now)
    {
        TemporaryBalance::where('period', 'month')
            ->whereDate('end_date', '<=', $now->endOfMonth())
            ->delete();
    }

    private function resetYearlyBalances(Carbon $now)
    {
        TemporaryBalance::where('period', 'year')
            ->whereDate('end_date', '<=', $now->endOfYear())
            ->delete();
    }
}
