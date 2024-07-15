<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Employee;

class ResetAuthorizationBalances extends Command
{
    protected $signature = 'auth:reset-balances';
    protected $description = 'Reset authorization balances for employees at the start of each month';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        Employee::query()->update([
            'sortie_balance' => 2.00, // 2 hours
            'teletravail_days_balance' => 5 // 5 days
        ]);

        $this->info('Authorization balances have been reset.');
    }
}
