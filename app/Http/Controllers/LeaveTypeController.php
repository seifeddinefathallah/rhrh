<?php

namespace App\Http\Controllers;

use App\Models\LeaveType;
use App\Models\Employee;
use App\Models\LeaveBalance;
use Illuminate\Http\Request;
//use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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

        $leaveType = LeaveType::create($request->all());

        $employees = Employee::all();
        foreach ($employees as $employee) {
            LeaveBalance::create([
                'employee_id' => $employee->id,
                'leave_type_id' => $leaveType->id,
                'remaining_days' => $leaveType->max_days,
            ]);
        }

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


    public function dashboard(Request $request)
    {

        $leaveTypeId = $request->input('leave_type_id');
        Log::info('Leave Type ID récupéré à partir de la requête', ['leave_type_id' => $leaveTypeId]);


        $employee = Auth::user(); // En supposant que Auth::user() renvoie le modèle Employee
        Log::info('Employé actuellement authentifié', ['employee_id' => $employee->id]);

        // Récupérer les enregistrements de LeaveBalance pour l'employé authentifié
        $leaveBalances = LeaveBalance::where('employee_id', $employee->id)->get();
        Log::info('Enregistrements de LeaveBalance récupérés', ['count' => $leaveBalances->count()]);

        // Filtrer les enregistrements en fonction de leave_type_id
        $filteredLeaveBalances = $leaveBalances->filter(function($leaveBalance) use ($leaveTypeId) {
            return $leaveBalance->leave_type_id == $leaveTypeId;
        });
        Log::info('Enregistrements de LeaveBalance filtrés', ['count' => $filteredLeaveBalances->count()]);

        // Extraire les remaining_days des enregistrements filtrés
        $remainingDaysList = $filteredLeaveBalances->pluck('remaining_days');
        Log::info('Liste des jours restants extraite', ['remaining_days_list' => $remainingDaysList]);

        // Passer la liste des remaining days à la vue
        return view('dashboard', compact('remainingDaysList'));
    }

}
