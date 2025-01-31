<?php

namespace App\Http\Controllers;

use App\Models\Entite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class EntiteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
        Log::info('Début du processus de création d\'entité.');

        // Validation basée sur le type d'entité
        $rules = [
            'nom' => 'required|string',
            'numero_fiscal' => 'required|string',
            'adresse' => 'required|string',
            'pays' => 'required|string',
            'contact' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'identifiant_etablissement' => 'required|string',
        ];

        if ($request->input('pays') === 'france') {
            $rules['numero_siret'] = 'required|string';
            $rules['code_ape_naf'] = 'required|string';
            $rules['convention_collective'] = 'required|string';
        } else {
            $rules['numero_siret'] = 'nullable|string';
            $rules['code_ape_naf'] = 'nullable|string';
            $rules['convention_collective'] = 'nullable|string';
        }

        $validatedData = $request->validate($rules);

        Log::info('Validation des données réussie.', $validatedData);

        // Gestion de l'image si elle est présente dans la requête
        $imagePath = null;
        if ($request->hasFile('image')) {
            try {
                $imagePath = $request->file('image')->store('entite_images', 'public');
                Log::info('Image téléchargée avec succès.', ['imagePath' => $imagePath]);
            } catch (\Exception $e) {
                Log::error('Erreur lors du téléchargement de l\'image.', ['error' => $e->getMessage()]);
                return redirect()->back()->withErrors('Erreur lors du téléchargement de l\'image: ' . $e->getMessage());
            }
        } else {
            Log::info('Aucune image fournie.');
        }

        // Création de l'entité avec les données validées
        try {
            $entite = Entite::create([
                'nom' => $request->nom,
                'numero_fiscal' => $request->numero_fiscal,
                'adresse' => $request->adresse,
                'pays' => $request->pays,
                'contact' => $request->contact,
                'numero_siret' => $request->numero_siret,
                'code_ape_naf' => $request->code_ape_naf,
                'convention_collective' => $request->convention_collective,
                'identifiant_etablissement' => $request->identifiant_etablissement,
                'image' => $imagePath, // Utiliser $imagePath directement
            ]);

            Log::info('Entité créée avec succès.', ['entite' => $entite]);

            // Redirection avec un message de succès
            return redirect()->route('entites.index')->with('success', 'Entité créée avec succès.');
        } catch (\Exception $e) {
            Log::error('Erreur lors de la création de l\'entité.', ['error' => $e->getMessage()]);
            return redirect()->back()->withErrors('Erreur lors de la création de l\'entité : ' . $e->getMessage());
        }
    }

    public function show(Entite $entite)
    {
        return view('entites.show', compact('entite'));
    }

    public function edit(Entite $entite)
    {

        return view('entites.edit', compact('entite')); // Pass it to the view
    }

    public function update(Request $request, Entite $entite)
    {
        // Validation basée sur le type d'entité
        $rules = [
            'nom' => 'required|string',
            'numero_fiscal' => 'required|string',
            'adresse' => 'required|string',
            'pays' => 'required|string',
            'contact' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        if ($request->input('pays') === 'france') {
            $rules['numero_siret'] = 'required|string';
            $rules['code_ape_naf'] = 'required|string';
            $rules['convention_collective'] = 'required|string';
        } else {
            $rules['numero_siret'] = 'nullable';
            $rules['code_ape_naf'] = 'nullable';
            $rules['convention_collective'] = 'nullable';
        }

        $request->validate($rules);

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

