<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\Employee;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contracts = Contract::latest()->paginate(10);
        $employees = Employee::all();
        return view('contracts.index', compact('contracts'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'type' => 'required|string',
            'classification' => 'nullable|string',
            'coefficient' => 'nullable|integer',
            'periode_essai_initiale' => 'nullable|string',
            'renouvellement' => 'nullable|string',
            'debut_contrat' => 'required|date',
            'fin_contrat' => 'nullable|date',
            'pays' => 'required|string',
        ]);

        $employee = Employee::findOrFail($request->employee_id);

        // Vérifier si l'employé a déjà un contrat
        if ($employee->contract) {
            return redirect()->route('contracts.index')
                ->with('error', 'Cet employé a déjà un contrat.');
        }

        $contract = new Contract($request->all());
        $employee->contract()->save($contract);

        return redirect()->route('contracts.index')
            ->with('success', 'Contrat créé avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contract = Contract::findOrFail($id);

        return view('contracts.show', compact('contract'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contract = Contract::findOrFail($id);
        return view('contracts.edit', compact('contract'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|string',
            'classification' => 'required|string',
            'coefficient' => 'nullable|integer',
            'periode_essai_initiale' => 'nullable|string',
            'renouvellement' => 'nullable|date',
            'duree_contrat' => 'nullable|string',
            'limite_contrat' => 'nullable|string',
        ]);

        $contract = Contract::findOrFail($id);
        $contract->update($request->all());

        return redirect()->route('contracts.index')
            ->with('success', 'Contrat mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contract = Contract::findOrFail($id);
        $contract->delete();

        return redirect()->route('contracts.index')
            ->with('success', 'Contrat supprimé avec succès.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int|null  $employeeId
     * @return \Illuminate\Http\Response
     */
    public function create($employeeId = null)
    {
        $employees = Employee::all(); // Récupérer tous les employés pour la liste déroulante

        if ($employeeId) {
            $employee = Employee::findOrFail($employeeId);
        } else {
            $employee = null;
        }

        return view('contracts.create', compact('employees', 'employee'));
    }

}
