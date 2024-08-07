<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Poste;
use Illuminate\Http\Request;

class PosteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $postes = Poste::with('departement')->get();
        return view('postes.index', compact('postes'));
    }

    public function create()
    {
        $departements = Departement::all();
        return view('postes.create', compact('departements'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'departement_id' => 'required|exists:departements,id',
        ]);

        Poste::create($request->all());

        return redirect()->route('postes.index')->with('success', 'Poste ajouté avec succès.');
    }

    public function edit(Poste $poste)
    {
        $departements = Departement::all();
        return view('postes.edit', compact('poste', 'departements'));
    }

    public function update(Request $request, Poste $poste)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'departement_id' => 'required|exists:departements,id',
        ]);

        $poste->update($request->all());

        return redirect()->route('postes.index')->with('success', 'Poste mis à jour avec succès.');
    }

    public function destroy(Poste $poste)
    {
        $poste->delete();

        return redirect()->route('postes.index')->with('success', 'Poste supprimé avec succès.');
    }
}
