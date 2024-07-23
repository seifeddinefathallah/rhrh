<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('auth:reset-balances')->monthlyOn(1, '00:00');
        $schedule->command('authorizations:process')->everyMinute();
        $schedule->command('balances:reset')->dailyAt('20:00'); // Pour réinitialiser quotidiennement
        $schedule->command('balances:reset')->monthly(); // Pour réinitialiser mensuellement
        $schedule->command('balances:reset')->yearly();
        $schedule->command('balances:update')->dailyAt('20:00');
        /*$schedule->command('auth:reset-balances')->everyMinute();
        $schedule->command('authorizations:process')->everyMinute();
        $schedule->command('balances:reset')->everyMinute(); // Test daily
        $schedule->command('balances:reset')->everyMinute(); // Test monthly
        $schedule->command('balances:reset')->everyMinute(); // Test yearly
        $schedule->command('balances:update')->everyMinute();*/
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
