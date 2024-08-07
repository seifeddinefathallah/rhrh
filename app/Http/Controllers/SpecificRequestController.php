<?php

namespace App\Http\Controllers;

use App\Mail\NewAdministrativeRequestNotification;
use App\Mail\SpecificRequestStatusUpdated;
use App\Models\MaterialRequest;
use App\Models\SpecificRequest;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\SpecificRequestCreated;
use Illuminate\Support\Facades\Mail;

class SpecificRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $requests = SpecificRequest::with('employee')->paginate(10);
        return view('specific_requests.index', compact('requests'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('specific_requests.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'request_type' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $employeeId = Auth::user()->employee->id;
        $specificRequest = SpecificRequest::create([
            'employee_id' => $employeeId,
            'request_type' => $request->request_type,
            'description' => $request->description,
            'status' => 'pending',
        ]);
        $employee = Employee::find(Auth::user()->employee->id);

        if (!$employee) {
            return redirect()->back()->with('error', 'Employee not found.');
        }
        if (empty($employee->email_professionnel)) {
            return redirect()->back()->with('error', 'Employee email address is missing.');
        }
        // Send the email
        $user = Auth::user();

        // Send email notification for the creation of the request
        if ($user) {
            Mail::to($employee->email_professionnel)->send(new SpecificRequestCreated($employee, $specificRequest));
        }

        return redirect()->route('specific_requests.index')->with('success', 'Specific request created successfully!');
    }

    public function show(SpecificRequest $specificRequest)
    {
        return view('specific_requests.show', compact('specificRequest'));
    }

    public function edit(SpecificRequest $specificRequest)
    {
        $employees = Employee::all();
        return view('specific_requests.edit', compact('specificRequest', 'employees'));
    }

    public function update(Request $request, SpecificRequest $specificRequest)
    {
        $request->validate([

            'request_type' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $specificRequest->update($request->all());

        return redirect()->route('specific_requests.index')->with('success', 'Specific request updated successfully!');
    }

    public function destroy(SpecificRequest $specificRequest)
    {
        $specificRequest->delete();
        return redirect()->route('specific_requests.index')->with('success', 'Specific request deleted successfully!');
    }
    public function approve(SpecificRequest $specificRequest)
    {
        $specificRequest->update(['status' => 'approved']);
        $employee = Employee::find(Auth::user()->employee->id);

        if (!$employee) {
            return redirect()->back()->with('error', 'Employee not found.');
        }
        if (empty($employee->email_professionnel)) {
            return redirect()->back()->with('error', 'Employee email address is missing.');
        }
        // Send the email
        $user = Auth::user();

        // Send email notification for the creation of the request
        if ($user) {
            Mail::to($employee->email_professionnel)->send(new SpecificRequestStatusUpdated($employee, $specificRequest));
        }
        return redirect()->route('specific_requests.index')->with('success', 'Specific request approved successfully.');
    }

    public function reject(SpecificRequest $specificRequest)
    {
        $specificRequest->update(['status' => 'rejected']);
        $employee = Employee::find(Auth::user()->employee->id);

        if (!$employee) {
            return redirect()->back()->with('error', 'Employee not found.');
        }
        if (empty($employee->email_professionnel)) {
            return redirect()->back()->with('error', 'Employee email address is missing.');
        }
        // Send the email
        $user = Auth::user();

        // Send email notification for the creation of the request
        if ($user) {
            Mail::to($employee->email_professionnel)->send(new SpecificRequestStatusUpdated($employee, $specificRequest));
        }
        return redirect()->route('specific_requests.index')->with('success', 'Specific request rejected successfully.');
    }
}

