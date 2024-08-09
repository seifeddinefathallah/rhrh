<?php

namespace App\Http\Controllers;

use App\Models\LeaveType;
use Illuminate\Http\Request;

class LeaveTypeController extends Controller
{
    public function index()
    {
        $leaveTypes = LeaveType::all();
        return view('leave_types.index', compact('leaveTypes'));
    }

    public function create()
    {
        return view('leave_types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'requires_medical_certificate' => 'nullable|boolean',
            'max_days' => 'nullable|integer|min:0',
        ]);

        LeaveType::create($request->all());

        return redirect()->route('leave_types.index')
            ->with('success', 'Type de congé créé avec succès.');
    }

    public function show(LeaveType $leaveType)
    {
        return view('leave_types.show', compact('leaveType'));
    }

    public function edit(LeaveType $leaveType)
    {
        return view('leave_types.edit', compact('leaveType'));
    }

    public function update(Request $request, LeaveType $leaveType)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'requires_medical_certificate' => 'nullable|boolean',
            'max_days' => 'nullable|integer|min:0',
        ]);

        $leaveType->update($request->all());

        return redirect()->route('leave_types.index')
            ->with('success', 'Type de congé mis à jour avec succès.');
    }

    public function destroy(LeaveType $leaveType)
    {
        $leaveType->delete();

        return redirect()->route('leave_types.index')
            ->with('success', 'Type de congé supprimé avec succès.');
    }
}
