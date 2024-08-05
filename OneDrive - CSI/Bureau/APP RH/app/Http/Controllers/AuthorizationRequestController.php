<?php

namespace App\Http\Controllers;

use Berkayk\OneSignal\OneSignalFacade as OneSignal;
use Illuminate\Http\Request;
use App\Models\AuthorizationRequest;
use App\Notifications\AuthorizationStatusNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use App\Models\TemporaryBalance;
use App\Models\PeriodDefinition;
use App\Models\DefaultBalance;
use Carbon\Carbon;


class AuthorizationRequestController extends Controller
{
    public function index()
    {
        // Query all AuthorizationRequests, sorted by latest
        $authorizations = AuthorizationRequest::latest()->paginate(10);

        return view('authorizations.index', compact('authorizations'));
    }

    public function create()
    {
        return view('authorizations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'start_time' => 'required|string',
            'end_time' => 'required|string',
            'duration_type' => $request->input('type') === 'Sortie' ? 'required|string' : 'nullable|string',
            //'duration' => 'nullable|string',
            'status' => 'required|string',
        ]);
        $employee = Auth::user()->employee;
        $startDateTime = \Carbon\Carbon::parse($request->start_date . ' ' . $request->start_time);
        $endDateTime = \Carbon\Carbon::parse($request->end_date . ' ' . $request->end_time);
        //$duration = $endDateTime->diffInHours($startDateTime) . ' hours';
        // Set default duration if duration_type is "half_day"
        if ($request->duration_type === 'half_day') {
            $request->merge(['duration' => '4 hours']);
        }
        if ($request->type === 'Sortie') {
            $durationMinutes = $endDateTime->diffInMinutes($startDateTime);
            $hoursRequested = $durationMinutes / 60;
            if ($employee->sortie_balance < $hoursRequested) {
                $errorMessage = 'Insufficient sortie balance. Available balance: ' . $employee->sortie_balance . ' hours.';
                return redirect()->back()->withErrors(['message' => $errorMessage]);
            }
            $duration = $hoursRequested . ' hours';
        } elseif ($request->type === 'Télétravail') {
            $daysRequested = $endDateTime->diffInDays($startDateTime) + 1;
            if ($request->duration_type === 'half day') {
                $daysRequested = 0.5; // For a half day
            }
            if ($employee->teletravail_days_balance < $daysRequested) {
                $errorMessage = 'Insufficient teletravail days balance. Available balance: ' . $employee->teletravail_days_balance . ' days.';
                return redirect()->back()->withErrors(['message' => $errorMessage]);
            }
            $duration = $daysRequested . ' days';
        }
        $authorization = new AuthorizationRequest($request->all());
        $authorization->user_id = Auth::id();
        $authorization->employee_id = Auth::user()->employee->id;
        $authorization->duration = $duration;
        $authorization->save();
        $authorization->user->notify(new AuthorizationStatusNotification($authorization));
        return redirect()->route('authorizations.index')->with('success', 'Authorization request submitted successfully.');
    }

    public function show(AuthorizationRequest $authorization)
    {
        //$this->authorize('view', $authorization); // Only authorized users can view their own authorizations
        return view('authorizations.show', compact('authorization'));
    }
    public function edit(AuthorizationRequest $authorization)
    {
        //$this->authorize('update', $authorization); // Assurez-vous que l'utilisateur est autorisé à mettre à jour cette autorisation

        return view('authorizations.edit', compact('authorization'));
    }
    public function update(Request $request, AuthorizationRequest $authorization)
    {
        $request->validate([
            'type' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'start_time' => 'required|string',
            'end_time' => 'required|string',
            'duration_type' => $request->input('type') === 'Sortie' ? 'required|string' : 'nullable|string',
            //'duration' => 'nullable|string',

        ]);

        // Calculate duration if necessary
        if ($request->has('start_date') && $request->has('start_time') && $request->has('end_date') && $request->has('end_time')) {
            $startDateTime = \Carbon\Carbon::parse($request->start_date . ' ' . $request->start_time);
            $endDateTime = \Carbon\Carbon::parse($request->end_date . ' ' . $request->end_time);
            $duration = $endDateTime->diffInHours($startDateTime) . ' hours';

            // Set default duration if duration_type is "half day"
            if ($request->duration_type === 'half day') {
                $duration = '4 hours';
            }
            if ($authorization->status === 'approved') {
                $this->updateEmployeeBalance(Auth::id(), $authorization);
            }

            $request->merge(['duration' => $duration]);
        }

        $authorization->update($request->all());

        // Notify the user about the status update
        $authorization->user->notify(new AuthorizationStatusNotification($authorization));

        return redirect()->route('authorizations.index')->with('success', 'Authorization request status updated successfully.');
    }
    /*protected function updateEmployeeBalance($employeeId, $authorization)
    {
        $employee = \App\Models\Employee::find($employeeId);

        if ($authorization->type === 'Sortie') {
            $hours = (int)str_replace(' hours', '', $authorization->duration);
            $employee->sortie_balance -= $hours;
        } elseif ($authorization->type === 'Teletravail') {
            $days = (int)$authorization->duration;
            $employee->teletravail_days_balance -= $days;
        }

        // Ensure balance does not go below zero
        $employee->sortie_balance = max(0, $employee->sortie_balance);
        $employee->teletravail_days_balance = max(0, $employee->teletravail_days_balance);

        $employee->save();
    }*/
    protected function updateEmployeeBalance($employeeId, $authorization)
    {
        $employee = Employee::find($employeeId);

        if (!$employee) {
            \Log::error("Employee not found: " . $employeeId);
            return;
        }

        $now = \Carbon\Carbon::now(); // Get current date and time
        $startDateTime = \Carbon\Carbon::parse($authorization->start_date . ' ' . $authorization->start_time);

        // Check if the current date and time match the start date and time of the authorization
        if ($now->isSameMinute($startDateTime)) {
            if ($authorization->type === 'Sortie') {
                // Extract hours from duration
                if (preg_match('/(\d+\.?\d*) hours/', $authorization->duration, $matches)) {
                    $hours = (float) $matches[1];
                    \Log::info("Decreasing sortie_balance by $hours hours");
                    $employee->sortie_balance -= $hours;
                }
            } elseif ($authorization->type === 'Télétravail') {
                // Extract days from duration
                if (preg_match('/(\d+\.?\d*) days/', $authorization->duration, $matches)) {
                    $days = (float) $matches[1];
                    \Log::info("Decreasing teletravail_days_balance by $days days");
                    $employee->teletravail_days_balance -= $days;
                }
            }

            // Ensure balance does not go below zero
            $employee->sortie_balance = max(0, $employee->sortie_balance);
            $employee->teletravail_days_balance = max(0, $employee->teletravail_days_balance);

            $employee->save();
        } else {
            \Log::info("Current time does not match the start time of the authorization request.");
        }
    }
   /* protected function updateEmployeeBalance($employeeId, $authorization)
    {
        // Find or create a DefaultBalance record for the employee
        $defaultBalance = DefaultBalance::firstOrCreate(['employee_id' => $employeeId]);

        if (!$defaultBalance) {
            \Log::error("DefaultBalance not found or could not be created for Employee ID: " . $employeeId);
            return;
        }

        $now = \Carbon\Carbon::now(); // Get current date and time
        $startDateTime = \Carbon\Carbon::parse($authorization->start_date . ' ' . $authorization->start_time);

        // Check if the current date and time match the start date and time of the authorization
        if ($now->isSameMinute($startDateTime)) {
            if ($authorization->type === 'Sortie') {
                // Extract hours from duration
                if (preg_match('/(\d+\.?\d*) hours/', $authorization->duration, $matches)) {
                    $hours = (float) $matches[1];
                    \Log::info("Decreasing sortie_balance by $hours hours");
                    $defaultBalance->sortie_balance -= $hours;
                }
            } elseif ($authorization->type === 'Télétravail') {
                // Extract days from duration
                if (preg_match('/(\d+\.?\d*) days/', $authorization->duration, $matches)) {
                    $days = (float) $matches[1];
                    \Log::info("Decreasing teletravail_days_balance by $days days");
                    $defaultBalance->teletravail_days_balance -= $days;
                }
            }

            // Ensure balance does not go below zero
            $defaultBalance->sortie_balance = max(0, $defaultBalance->sortie_balance);
            $defaultBalance->teletravail_days_balance = max(0, $defaultBalance->teletravail_days_balance);

            $defaultBalance->save();
        } else {
            \Log::info("Current time does not match the start time of the authorization request.");
        }
    }*/

    public function destroy(AuthorizationRequest $authorization)
    {

        //$this->authorize('delete', $authorization); // Only authorized users can delete their own authorizations

        $authorization->delete();

        return redirect()->route('authorizations.index')->with('success', 'Authorization request deleted successfully.');
    }

    /*public function approve(AuthorizationRequest $authorization)
    {
        $this->authorize('update', $authorization); // Only authorized users can approve authorizations

        $authorization->update(['status' => 'approved']);

        // Notify the user about the approval
        $authorization->user->notify(new AuthorizationStatusNotification($authorization));

        return redirect()->route('authorizations.index')->with('success', 'Authorization request approved successfully.');
    }

    public function reject(AuthorizationRequest $authorization)
    {
        $this->authorize('update', $authorization); // Only authorized users can reject authorizations

        $authorization->update(['status' => 'rejected']);

        // Notify the user about the rejection
        $authorization->user->notify(new AuthorizationStatusNotification($authorization));

        return redirect()->route('authorizations.index')->with('success', 'Authorization request rejected successfully.');
    }*/
    /*public function approve(AuthorizationRequest $authorization)
    {
        $this->authorize('update', $authorization);

        $employee = $authorization->employee;
        if ($authorization->type === 'Sortie') {
            $hoursRequested = (int) filter_var($authorization->duration, FILTER_SANITIZE_NUMBER_INT);
            $employee->sortie_balance -= $hoursRequested;
        } elseif ($authorization->type === 'Télétravail') {
            $daysRequested = $authorization->end_date->diffInDays($authorization->start_date) + 1;
            $employee->teletravail_days_balance -= $daysRequested;
        }

        $employee->save();
        $authorization->update(['status' => 'approved']);
        $authorization->user->notify(new AuthorizationStatusNotification($authorization));

        return redirect()->route('authorizations.index')->with('success', 'Authorization request approved successfully.');
    }*/
    public function approve(Request $request, AuthorizationRequest $authorization)
    {
        //$this->authorize('update', $authorization);

        DB::beginTransaction();

        try {
            $authorization->update(['status' => 'approved']);
            $this->updateEmployeeBalance($authorization->employee_id, $authorization);

            $authorization->user->notify(new AuthorizationStatusNotification($authorization));

            DB::commit();
            return redirect()->route('authorizations.index')->with('success', 'Authorization request approved successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Approval Failed: ' . $e->getMessage());
            return redirect()->route('authorizations.index')->with('error', 'Failed to approve the request.');
        }
    }

    public function reject(Request $request, AuthorizationRequest $authorization)
    {
        //$this->authorize('update', $authorization);

        $authorization->update(['status' => 'rejected']);

        $authorization->user->notify(new AuthorizationStatusNotification($authorization));

        return redirect()->route('authorizations.index')->with('success', 'Authorization request rejected successfully.');
    }

    public function updateTemporaryBalances(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'period' => 'required|string|in:day,month,year',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'sortie_hours' => 'required|numeric|min:0',
            'teletravail_days' => 'required|numeric|min:0',
        ]);

        // Determine the period definition
        $periodDefinition = PeriodDefinition::firstOrCreate([
            'name' => $request->period,
            'days' => $this->getDaysInPeriod($request->period),
        ]);

        // Get all employees
        $employees = Employee::all();

        foreach ($employees as $employee) {
            // Calculate days in the specified period
            $daysInPeriod = $this->getDaysInPeriod($request->period);

            // Find or create temporary balances for the employee within the specified period
            for ($date = Carbon::parse($request->start_date); $date->lte(Carbon::parse($request->end_date)); $date->addDays($daysInPeriod)) {
                $endPeriodDate = $date->copy()->addDays($daysInPeriod - 1)->endOfDay();

                $temporaryBalance = TemporaryBalance::updateOrCreate(
                    [
                        'employee_id' => $employee->id,
                        'start_date' => $date->toDateString(),
                        'end_date' => $endPeriodDate->toDateTimeString(),
                    ],
                    [
                        'sortie_hours' => $request->sortie_hours,
                        'teletravail_days' => $request->teletravail_days,
                        'period_definition_id' => $periodDefinition->id,
                    ]
                );

                // Update employee's balances if the temporary balance is for today
                if (Carbon::parse($temporaryBalance->start_date)->isToday()) {
                    $employee->sortie_balance = $temporaryBalance->sortie_hours;
                    $employee->teletravail_days_balance = $temporaryBalance->teletravail_days;
                    $employee->save();
                }

                // Handle expiration based on the period and current time
                $this->handleTemporaryBalanceExpiration($employee, $temporaryBalance, $request->period, $date->toDateString(), $endPeriodDate->toDateTimeString());
            }
        }
        try {
            OneSignal::sendNotificationToAll("Une mise a jour a ete effectue pour les autorisations pour cette periode : {$temporaryBalance->period_definition_id} Solde de sortie {$temporaryBalance->sortie_hours} hours, Solde de teletravail {$temporaryBalance->teletravail_days} days ");
            Log::info('Notification sent successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to send OneSignal notification: ' . $e->getMessage());
        }

        return redirect()->route('authorizations.index')->with('success', 'Temporary balances updated successfully.');
    }

    private function handleTemporaryBalanceExpiration($employee, $temporaryBalance, $period, $startDate, $endDate)
    {
        switch ($period) {
            case 'day':
                $this->handleDailyExpiration($employee, $temporaryBalance, $startDate);
                break;
            case 'month':
                $this->handleMonthlyExpiration($employee, $temporaryBalance, $startDate);
                break;
            case 'year':
                $this->handleYearlyExpiration($employee, $temporaryBalance, $startDate);
                break;
            default:
                break;
        }

        // Always delete expired temporary balances
        if (Carbon::now()->gt(Carbon::parse($endDate))) {
            $temporaryBalance->delete();
        }
    }

    private function handleDailyExpiration($employee, $temporaryBalance, $startDate)
    {
        // Check if it's the same day and past the expiration time
        if (Carbon::parse($startDate)->isToday()) {
            $endDateTime = Carbon::parse($startDate)->addHours(20); // Assuming 8 hours validity from start
            Log::warning('endDateTime ' . $endDateTime);
            // Check if current time is after the expiration time
            if (Carbon::now()->gt($endDateTime)) {
                $this->applyDefaultBalance($employee);
                $temporaryBalance->delete();
            }
        }
    }

    private function handleMonthlyExpiration($employee, $temporaryBalance, $startDate)
    {
        // Check if the current month is different from the start date's month
        if (Carbon::parse($startDate)->month != Carbon::now()->month) {
            $this->applyDefaultBalance($employee);
            $temporaryBalance->delete();
        }
    }

    private function handleYearlyExpiration($employee, $temporaryBalance, $startDate)
    {
        // Check if the current year is different from the start date's year
        if (Carbon::parse($startDate)->year != Carbon::now()->year) {
            $this->applyDefaultBalance($employee);
            $temporaryBalance->delete();
        }
    }

    private function applyDefaultBalance($employee)
    {
        // Get the default balance for the employee
        $defaultBalance = DefaultBalance::where('employee_id', $employee->id)->first();

        if ($defaultBalance) {
            $employee->sortie_balance = $defaultBalance->sortie_balance;
            $employee->teletravail_days_balance = $defaultBalance->teletravail_days_balance;
            $employee->save();
        } else {
            // Handle case where default balance does not exist
            Log::warning('Default balance not found for employee ' . $employee->id);
        }
    }

    private function getDaysInPeriod($period)
    {
        switch ($period) {
            case 'day':
                return 1;
            case 'month':
                return now()->daysInMonth;
            case 'year':
                return now()->isLeapYear() ? 366 : 365;
            default:
                return 1;
        }
    }
}
