<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Entite;
use Illuminate\Http\Request;

class DepartementController extends Controller
{
    public function index()
    {
        $departements = Departement::all();
        return view('departements.index', compact('departements'));
    }

    public function create()
    {
        return view('departements.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|unique:departements,nom',
        ]);

        $departement = Departement::create($request->all());

        return redirect()->route('departements.index')
            ->with('success', 'Département ajouté avec succès.');
    }

    public function edit(Departement $departement)
    {
        return view('departements.edit', compact('departement'));
    }

    public function update(Request $request, Departement $departement)
    {
        $request->validate([
            'nom' => 'required|unique:departements,nom,' . $departement->id,
        ]);

        $departement->update($request->all());

        return redirect()->route('departements.index')
            ->with('success', 'Département mis à jour avec succès.');
    }

    public function destroy(Departement $departement)
    {
        $departement->delete();

        return redirect()->route('departements.index')
            ->with('success', 'Département supprimé avec succès.');
    }

    public function assignEntite(Request $request, Departement $departement)
    {
        // Valider les données reçues du formulaire
        $request->validate([
            'entites' => 'required|array',
            'entites.*' => 'integer|exists:entites,id',
        ]);

        // Synchroniser les entités avec le département
        $departement->entites()->sync($request->entites);

        return redirect()->route('departements.index')
            ->with('success', 'Entités assignées avec succès au département.');
    }
    public function showAssignEntiteForm(Departement $departement)
    {
        $entites = Entite::all();
        return view('departements.assign', compact('departement', 'entites'));
    }

    public function show(Departement $departement)
{
    return view('departements.show', compact('departement'));
}

}
