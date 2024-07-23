@extends('layouts.app')



@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Ajouter une nouvelle entité') }}
            </h2>
            <form action="{{ route('entites.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                <div class="form-group">
                    <label for="image">Image de l'entité</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                </div>
                <div>
                    <label class="form-label">Nom :</label>
                    <input type="text" name="nom" required class="form-control">
                </div>
                <div>
                    <label class="form-label">Numéro Fiscal :</label>
                    <input type="text" name="numero_fiscal" required class="form-control">
                </div>
                <div>
                    <label class="form-label">Adresse :</label>
                    <input type="text" name="adresse" required class="form-control">
                </div>
                <div>
                    <label class="form-label">Pays :</label>
                    <input type="text" name="pays" required class="form-control">
                </div>
                <div>
                    <label class="form-label">Contact :</label>
                    <input type="text" name="contact" required class="form-control">
                </div>
                <div>
                    <label class="form-label">Nom de l'employeur :</label>
                    <input type="text" name="nom_employeur" required class="form-control">
                </div>
                <div>
                    <label class="form-label">Adresse de l'employeur :</label>
                    <input type="text" name="adresse_employeur" required class="form-control">
                </div>
                <div>
                    <label class="form-label">Numéro SIRET :</label>
                    <input type="text" name="numero_siret" required class="form-control">
                </div>
                <div>
                    <label class="form-label">Code APE/NAF :</label>
                    <input type="text" name="code_ape_naf" required class="form-control">
                </div>
                <div>
                    <label class="form-label">Convention Collective :</label>
                    <input type="text" name="convention_collective" required class="form-control">
                </div>
                <div>
                    <label class="form-label">Identifiant de l’établissement :</label>
                    <input type="text" name="identifiant_etablissement" required class="form-control">
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
