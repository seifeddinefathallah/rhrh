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
                           
                            
                            

                            <!-- Informations sur l'entité -->
                            <div class="col-md-4 mb-3">
                                <p class="font-weight-bold-custom">Nom :</p>
                                <p>{{ $entite->nom }}</p>
                                 <div class="text-center">
                                    @if ($entite->image)
                                        <img src="{{ asset('storage/' . $entite->image) }}" alt="Image de l'entité" class="img-fluid" style="max-width: 100%; height: auto;">
                                    @else
                                        <p>Aucune image disponible</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <p class="font-weight-bold-custom">Numéro Fiscal :</p>
                                <p>{{ $entite->numero_fiscal }}</p>
                            </div>
                            <div class="col-md-4 mb-3">
                                <p class="font-weight-bold-custom">Adresse :</p>
                                <p>{{ $entite->adresse }}</p>
                            </div>
                            <div class="col-md-4 mb-3">
                                <p class="font-weight-bold-custom">Pays :</p>
                                <p>{{ $entite->pays }}</p>
                            </div>
                            <div class="col-md-4 mb-3">
                                <p class="font-weight-bold-custom">Contact :</p>
                                <p>{{ $entite->contact }}</p>
                            </div>
                            <div class="col-md-4 mb-3">
                                <p class="font-weight-bold-custom">Nom de l'employeur :</p>
                                <p>{{ $entite->nom_employeur }}</p>
                            </div>
                            <div class="col-md-4 mb-3">
                                <p class="font-weight-bold-custom">Adresse de l'employeur :</p>
                                <p>{{ $entite->adresse_employeur }}</p>
                            </div>
                            <div class="col-md-4 mb-3">
                                <p class="font-weight-bold-custom">Numéro SIRET :</p>
                                <p>{{ $entite->numero_siret }}</p>
                            </div>
                            <div class="col-md-4 mb-3">
                                <p class="font-weight-bold-custom">Code APE/NAF :</p>
                                <p>{{ $entite->code_ape_naf }}</p>
                            </div>
                            <div class="col-md-4 mb-3">
                                <p class="font-weight-bold-custom">Convention Collective :</p>
                                <p>{{ $entite->convention_collective }}</p>
                            </div>
                            <div class="col-md-4 mb-3">
                                <p class="font-weight-bold-custom">Identifiant de l’établissement :</p>
                                <p>{{ $entite->identifiant_etablissement }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4">
                    <a href="{{ route('entites.index') }}" class="btn btn-secondary float-end">
                        Retour à la liste
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
