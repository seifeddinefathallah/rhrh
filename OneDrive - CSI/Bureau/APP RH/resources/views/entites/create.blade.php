@extends('layouts.app')

@section('content')
<div id="main-layout" class="layout-container" style="width: 85%; position: relative; left: 16%;">
    <div class=" container-xxl mx-auto flex-grow-1 container-p-y">  
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                
                <h1 class="text-2xl font-bold text-center my-6">Ajouter une nouvelle entité</h1>
                <form action="{{ route('entites.store') }}" method="POST" class="p-6">
                 
                   
                    @csrf
                    <div>
                        <label>Nom </label>
                        <input class="form-control" type="text" name="nom" required>
                    </div>
                    <div>
                        <label>Numéro Fiscal </label>
                        <input class="form-control"type="text" name="numero_fiscal" required>
                    </div>
                    <div>
                        <label>Adresse </label>
                        <input class="form-control" type="text" name="adresse" required>
                    </div>
                    <div>
                        <label>Pays </label>
                        <input class="form-control" type="text" name="pays" required>
                    </div>
                    <div>
                        <label>Contact </label>
                        <input class="form-control" type="text" name="contact" required>
                    </div>
                    <div>
                        <label>Nom de l'employeur </label>
                        <input class="form-control" type="text" name="nom_employeur" required>
                    </div>
                    <div>
                        <label>Adresse de l'employeur </label>
                        <input class="form-control" type="text" name="adresse_employeur" required>
                    </div>
                    <div>
                        <label>Numéro SIRET </label>
                        <input class="form-control" type="text" name="numero_siret" required>
                    </div>
                    <div>
                        <label>Code APE/NAF </label>
                        <input class="form-control" type="text" name="code_ape_naf" required>
                    </div>
                    <div>
                        <label>Convention Collective </label>
                        <input class="form-control" type="text" name="convention_collective" required>
                    </div>
                    <div>
                        <label>Identifiant de l’établissement </label>
                        <input class="form-control" type="text" name="identifiant_etablissement" required>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
