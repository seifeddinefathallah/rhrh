<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AuthorizationRequest;
use App\Models\Employee;
use Carbon\Carbon;

class ProcessAuthorizations extends Command
{
    protected $signature = 'authorizations:process';
    protected $description = 'Process due authorizations and update employee balances';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        try {
        $now = Carbon::now();

        $authorizations = AuthorizationRequest::where('status', 'approved')
            ->whereDate('start_date', $now->toDateString())
            ->whereTime('start_time', $now->format('H:i'))
            ->get();

        foreach ($authorizations as $authorization) {
            $employee = Employee::find($authorization->employee_id);

            if (!$employee) {
                \Log::error("Employee not found: " . $authorization->employee_id);
                continue;
            }

            if ($authorization->type === 'Sortie') {
                if (preg_match('/(\d+\.?\d*) hours/', $authorization->duration, $matches)) {
                    $hours = (float) $matches[1];
                    \Log::info("Decreasing sortie_balance by $hours hours for employee ID: " . $authorization->employee_id);
                    $employee->sortie_balance -= $hours;
                }
            } elseif ($authorization->type === 'Télétravail') {
                if (preg_match('/(\d+\.?\d*) days/', $authorization->duration, $matches)) {
                    $days = (float) $matches[1];
                    \Log::info("Decreasing teletravail_days_balance by $days days for employee ID: " . $authorization->employee_id);
                    $employee->teletravail_days_balance -= $days;
                }
            }

            // Ensure balance does not go below zero
            $employee->sortie_balance = max(0, $employee->sortie_balance);
            $employee->teletravail_days_balance = max(0, $employee->teletravail_days_balance);

            $employee->save();
        }

        \Log::info("Processed authorizations at " . $now->toDateTimeString());
        } catch (\Exception $e) {
            $this->error($e->getMessage());
            return 1;
        }
    }

}
