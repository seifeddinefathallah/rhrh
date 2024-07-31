@extends('layouts.app')

@section('content')
<div class="layout-container" style="width: 85%; position: relative; left: 16%;">
    <div class="container-xxl flex-grow-1 container-p-y">  
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> 
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">
                    Informations sur l'entité
                </h2>
                
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <p class="font-weight-bold">Nom :</p>
                                <p>{{ $entite->nom }}</p>
                            </div>
                            <div class="col-md-4">
                                <p class="font-weight-bold">Numéro Fiscal :</p>
                                <p>{{ $entite->numero_fiscal }}</p>
                            </div>
                            <div class="col-md-4">
                                <p class="font-weight-bold">Adresse :</p>
                                <p>{{ $entite->adresse }}</p>
                            </div>
                            <div class="col-md-4">
                                <p class="font-weight-bold">Pays :</p>
                                <p>{{ $entite->pays }}</p>
                            </div>
                            <div class="col-md-4">
                                <p class="font-weight-bold">Contact :</p>
                                <p>{{ $entite->contact }}</p>
                            </div>
                            <div class="col-md-4">
                                <p class="font-weight-bold">Nom de l'employeur :</p>
                                <p>{{ $entite->nom_employeur }}</p>
                            </div>
                            <div class="col-md-4">
                                <p class="font-weight-bold">Adresse de l'employeur :</p>
                                <p>{{ $entite->adresse_employeur }}</p>
                            </div>
                            <div class="col-md-4">
                                <p class="font-weight-bold">Numéro SIRET :</p>
                                <p>{{ $entite->numero_siret }}</p>
                            </div>
                            <div class="col-md-4">
                                <p class="font-weight-bold">Code APE/NAF :</p>
                                <p>{{ $entite->code_ape_naf }}</p>
                            </div>
                            <div class="col-md-4">
                                <p class="font-weight-bold">Convention Collective :</p>
                                <p>{{ $entite->convention_collective }}</p>
                            </div>
                            <div class="col-md-4">
                                <p class="font-weight-bold">Identifiant de l’établissement :</p>
                                <p>{{ $entite->identifiant_etablissement }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4">
                    <a href="{{ route('entites.index') }}" class="btn btn-primary float-end">
                        Retour à la liste
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
