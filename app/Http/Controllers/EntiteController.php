<?php

namespace App\Http\Controllers;

use App\Models\Entite;
use Illuminate\Http\Request;

class EntiteController extends Controller
{
    public function index()
    {
        $entites = Entite::latest()->paginate(10);
        return view('entites.index', compact('entites'));
    }

    public function create()
    {
        return view('entites.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'numero_fiscal' => 'required',
            'adresse' => 'required',
            'pays' => 'required',
            'contact' => 'required',
            'nom_employeur' => 'required',
            'adresse_employeur' => 'required',
            'numero_siret' => 'required',
            'code_ape_naf' => 'required',
            'convention_collective' => 'required',
            'identifiant_etablissement' => 'required',
        ]);

        Entite::create($request->all());

        return redirect()->route('entites.index')->with('success', 'Entité créée avec succès.');
    }

    public function show(Entite $entite)
    {
        return view('entites.show', compact('entite'));
    }

    public function edit(Entite $entite)
    {
        return view('entites.edit', compact('entite'));
    }

    public function update(Request $request, Entite $entite)
    {
        $request->validate([
            'nom' => 'required',
            'numero_fiscal' => 'required',
            'adresse' => 'required',
            'pays' => 'required',
            'contact' => 'required',
            'nom_employeur' => 'required',
            'adresse_employeur' => 'required',
            'numero_siret' => 'required',
            'code_ape_naf' => 'required',
            'convention_collective' => 'required',
            'identifiant_etablissement' => 'required',
        ]);

        $entite->update($request->all());

        return redirect()->route('entites.index')->with('success', 'Entité mise à jour avec succès.');
    }

    public function destroy(Entite $entite)
    {
        $entite->delete();

        return redirect()->route('entites.index')->with('success', 'Entité supprimée avec succès.');
    }
}
