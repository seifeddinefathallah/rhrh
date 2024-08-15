<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Employee;
use App\Notifications\EventUpdatedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\EventInvitationNotification;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('user_id', Auth::id())->get();
        return view('events.index', compact('events'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('events.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'start_time' => 'required|date',
            'end_time' => 'nullable|date|after_or_equal:start_time',
            'location' => 'nullable|string|max:255',
            'type' => 'required|string|max:50',
            'employees' => 'array', // Array of employee IDs
            'employees.*' => 'exists:employees,id', // Validate each employee ID
        ]);

        $event = Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'location' => $request->location,
            'type' => $request->type,
            'user_id' => Auth::id(),
        ]);

        // Attach selected employees to the event
        if ($request->has('employees')) {
            $event->employees()->sync($request->employees);

            // Notify each selected employee
            foreach ($request->employees as $employeeId) {
                $employee = Employee::find($employeeId);
                $employee->notify(new EventInvitationNotification($event));
            }
        }

        return redirect()->route('events.index')->with('success', 'Event created successfully and invitations sent.');
    }




    public function show(Event $event)
    {

        return view('events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        $employees = Employee::all();
        return view('events.edit', compact('event', 'employees'));
    }

    public function update(Request $request, Event $event)
    {
        // Validate only the fields you wish to update
        $request->validate([
            'title' => 'required|string|max:255',
            'start_time' => 'required|date',
            'end_time' => 'nullable|date|after_or_equal:start_time',
            'location' => 'nullable|string|max:255',
            'type' => 'required|string|max:50',
            'employees' => 'array',
            'employees.*' => 'exists:employees,id',
        ]);

        // Update the event with validated data
        $event->update([
            'title' => $request->title,
            'description' => $request->description,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'location' => $request->location,
            'type' => $request->type,
        ]);

        // Sync the employees with the updated event
        $event->employees()->sync($request->employees);

        // Notify each selected employee of the update
        foreach ($request->employees as $employeeId) {
            $employee = Employee::find($employeeId);
            $employee->notify(new EventUpdatedNotification($event));
        }

        return redirect()->route('events.index')->with('success', 'Event updated successfully and notifications sent.');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }
}
