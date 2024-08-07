<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContractType; // Assurez-vous d'importer le modèle ContractType

class ContractTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contractTypes = ContractType::all();
        return view('contract-types.index', compact('contractTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contract-types.create');
    }
    public function search(Request $request)
    {
        $search = $request->input('search');

        $contractTypes = ContractType::where('name', 'like', "%{$search}%")

                         ->get();

        return view('contract-types.index', compact('contractTypes', 'search'));
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'country' => 'required|string|max:255',
            'classification' => 'nullable|string|max:255',
            'coefficient' => 'nullable|numeric',
            'probation_period' => 'nullable|integer',
            'renouvellement' => 'nullable|boolean',
            'cdt_renouv' => 'nullable|integer',
        ]);

        ContractType::create($request->all());

        return redirect()->route('contract-types.index')
                         ->with('success', 'Contract type created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contractType = ContractType::findOrFail($id);
        return view('contract-types.show', compact('contractType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contractType = ContractType::findOrFail($id);
        return view('contract-types.edit', compact('contractType'));
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'country' => 'required|string|max:255',
            'classification' => 'nullable|string|max:255',
            'coefficient' => 'nullable|numeric',
            'probation_period' => 'nullable|integer',
        ]);

        $contractType = ContractType::findOrFail($id);
        $contractType->update($request->all());

        return redirect()->route('contract-types.index')
                         ->with('success', 'Contract type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contractType = ContractType::findOrFail($id);
        $contractType->delete();

        return redirect()->route('contract-types.index')
                         ->with('success', 'Contract type deleted successfully.');
    }
}
