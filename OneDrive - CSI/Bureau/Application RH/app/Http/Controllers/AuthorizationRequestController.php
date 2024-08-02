<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AuthorizationRequest;
use App\Notifications\AuthorizationStatusNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use Illuminate\Support\Facades\Log;

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
                return redirect()->back()->withErrors(['message' => 'Insufficient sortie balance']);
            }
            $duration = $hoursRequested . ' hours';
        } elseif ($request->type === 'Télétravail') {
            $daysRequested = $endDateTime->diffInDays($startDateTime) + 1;
            if ($request->duration_type === 'half day') {
                $daysRequested = 0.5; // For a half day
            }
            if ($employee->teletravail_days_balance < $daysRequested) {
                return redirect()->back()->withErrors(['message' => 'Insufficient teletravail days balance']);
            }
            $duration = $daysRequested . ' days';
        }
        $authorization = new AuthorizationRequest($request->all());
        $authorization->user_id = Auth::id();
        $authorization->employee_id = Auth::id();
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
            'duration_type' => 'nullable|string', // Adjust as per your validation rules
            'duration' => 'nullable|string',
            'status' => 'required|string',
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
   /* protected function updateEmployeeBalance($employeeId, $authorization)
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
            \Log::error('Approval Failed: ' . $e->getMessage());
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
}
