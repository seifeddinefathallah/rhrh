<?php

namespace App\Http\Controllers;

use App\Models\Entite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'nom' => 'required|string',
            'numero_fiscal' => 'required|string',
            'adresse' => 'required|string',
            'pays' => 'required|string',
            'contact' => 'required|string',
            'nom_employeur' => 'required|string',
            'adresse_employeur' => 'required|string',
            'numero_siret' => 'required|string',
            'code_ape_naf' => 'required|string',
            'convention_collective' => 'required|string',
            'identifiant_etablissement' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Gestion de l'image si elle est présente dans la requête
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('entite_images', 'public');
            $request->image = $imagePath;
        }

        // Création de l'entité avec les données validées
        $entite = Entite::create([
            'nom' => $request->nom,
            'numero_fiscal' => $request->numero_fiscal,
            'adresse' => $request->adresse,
            'pays' => $request->pays,
            'contact' => $request->contact,
            'nom_employeur' => $request->nom_employeur,
            'adresse_employeur' => $request->adresse_employeur,
            'numero_siret' => $request->numero_siret,
            'code_ape_naf' => $request->code_ape_naf,
            'convention_collective' => $request->convention_collective,
            'identifiant_etablissement' => $request->identifiant_etablissement,
            'image' => $request->image ?? null, // Assurez-vous que l'image est bien définie ou null
        ]);

        // Redirection avec un message de succès
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
            'nom' => 'required|string',
            'numero_fiscal' => 'required|string',
            'adresse' => 'required|string',
            'pays' => 'required|string',
            'contact' => 'required|string',
            'nom_employeur' => 'required|string',
            'adresse_employeur' => 'required|string',
            'numero_siret' => 'required|string',
            'code_ape_naf' => 'required|string',
            'convention_collective' => 'required|string',
            'identifiant_etablissement' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Gérer le téléchargement de la nouvelle image si elle est fournie
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($entite->image && Storage::disk('public')->exists($entite->image)) {
                Storage::disk('public')->delete($entite->image);
            }

            // Enregistrer la nouvelle image téléchargée
            $imagePath = $request->file('image')->store('entite_images', 'public');
            $entite->image = $imagePath;
        }

        // Mettre à jour les autres champs de l'entité avec les données du formulaire
        $entite->nom = $request->nom;
        $entite->numero_fiscal = $request->numero_fiscal;
        $entite->adresse = $request->adresse;
        $entite->pays = $request->pays;
        $entite->contact = $request->contact;
        $entite->nom_employeur = $request->nom_employeur;
        $entite->adresse_employeur = $request->adresse_employeur;
        $entite->numero_siret = $request->numero_siret;
        $entite->code_ape_naf = $request->code_ape_naf;
        $entite->convention_collective = $request->convention_collective;
        $entite->identifiant_etablissement = $request->identifiant_etablissement;

        // Sauvegarder les modifications de l'entité
        $entite->save();

        return redirect()->route('entites.index')->with('success', 'Entité mise à jour avec succès.');
    }

    public function destroy(Entite $entite)
    {
        if ($entite->image) {
            Storage::disk('public')->delete($entite->image);
        }
        $entite->delete();

        return redirect()->route('entites.index')->with('success', 'Entité supprimée avec succès.');
    }
}
