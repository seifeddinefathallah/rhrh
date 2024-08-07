<?php

namespace App\Http\Controllers;

use App\Models\MaterialRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\MaterialRequestCreated;
use Illuminate\Support\Facades\Mail;
use App\Mail\MaterialRequestStatusUpdated;

class MaterialRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $requests = MaterialRequest::all();
        return view('material_requests.index', compact('requests'));
    }

    public function create()
    {
        return view('material_requests.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'material_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer',
        ]);
        $employeeId = Auth::user()->employee->id;
        $materialRequest = MaterialRequest::create([
            'employee_id' => $employeeId,
            'material_name' => $request->material_name,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'status' => 'pending',
        ]);
        Mail::to($materialRequest->employee->email_professionnel)
            ->send(new MaterialRequestCreated($materialRequest));

        return redirect()->route('material_requests.index')->with('success', 'Request created successfully.');
    }

    public function show(MaterialRequest $materialRequest)
    {
        return view('material_requests.show', compact('materialRequest'));
    }

    public function edit(MaterialRequest $materialRequest)
    {
        return view('material_requests.edit', compact('materialRequest'));
    }

    public function update(Request $request, MaterialRequest $materialRequest)
    {
        $request->validate([
            'material_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer',
        ]);

        $materialRequest->update($request->all());


        return redirect()->route('material_requests.index')->with('success', 'Request updated successfully.');
    }

    public function destroy(MaterialRequest $materialRequest)
    {
        $materialRequest->delete();
        return redirect()->route('material_requests.index')->with('success', 'Request deleted successfully.');
    }

    public function approve(MaterialRequest $materialRequest)
    {
        $materialRequest->update(['status' => 'approved']);
        Mail::to($materialRequest->employee->email_professionnel)
            ->send(new MaterialRequestStatusUpdated($materialRequest));
        return redirect()->route('material_requests.index')->with('success', 'Request approved successfully.');
    }

    public function reject(MaterialRequest $materialRequest)
    {
        $materialRequest->update(['status' => 'rejected']);
        Mail::to($materialRequest->employee->email_professionnel)
            ->send(new MaterialRequestStatusUpdated($materialRequest));
        return redirect()->route('material_requests.index')->with('success', 'Request rejected successfully.');
    }
}

