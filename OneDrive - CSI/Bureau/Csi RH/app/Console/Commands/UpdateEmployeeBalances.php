<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AuthorizationRequest;
use App\Models\Employee;
use App\Models\DefaultBalance;
use Carbon\Carbon;

class UpdateEmployeeBalances extends Command
{
    protected $signature = 'balances:update';
    protected $description = 'Update employee balances daily at 8 PM';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $now = Carbon::now();
        if ($now->hour == 20) {
            $authorizations = AuthorizationRequest::where('status', 'approved')
                ->whereDate('end_date', $now->toDateString())
                ->get();

            foreach ($authorizations as $authorization) {
                $employee = $authorization->employee;
                $this->updateBalance($employee, $authorization);
            }
        }
    }

    private function updateBalance($employee, $authorization)
    {
        $defaultBalance = DefaultBalance::firstOrCreate(['employee_id' => $employee->id]);

        if ($authorization->type === 'Sortie') {
            if (preg_match('/(\d+\.?\d*) hours/', $authorization->duration, $matches)) {
                $hours = (float) $matches[1];
                \Log::info("Decreasing sortie_balance by $hours hours for employee ID {$employee->id}");
                $defaultBalance->sortie_balance -= $hours;
            }
        } elseif ($authorization->type === 'Télétravail') {
            if (preg_match('/(\d+\.?\d*) days/', $authorization->duration, $matches)) {
                $days = (float) $matches[1];
                \Log::info("Decreasing teletravail_days_balance by $days days for employee ID {$employee->id}");
                $defaultBalance->teletravail_days_balance -= $days;
            }
        }

        $defaultBalance->sortie_balance = max(0, $defaultBalance->sortie_balance);
        $defaultBalance->teletravail_days_balance = max(0, $defaultBalance->teletravail_days_balance);
        $defaultBalance->save();
    }
}
