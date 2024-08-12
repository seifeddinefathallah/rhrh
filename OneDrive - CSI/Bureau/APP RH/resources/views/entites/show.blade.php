@extends('layouts.app')

@section('content')
<div class="layout-container max-w-7xl mx-auto sm:px-6 lg:px-8" >
    <div class="container-xl flex-grow-1 container-p-y">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-3 bg-white border-b border-gray-200">
                <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">
                    Informations sur l'entité
                </h2>
                
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <!-- Image -->
                            <div class="col-md-4 mb-3 text-center">
                                @if ($entite->image)
                                    <img src="{{ asset('storage/' . $entite->image) }}" alt="Image de l'entité" class="img-fluid" style="max-width: 100%; height: auto;">
                                @else
                                    <p>Aucune image disponible</p>
                                @endif
                            </div>

                            <!-- Informations sur l'entité -->
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <p class="font-weight-bold-custom">Nom :</p>
                                        <p>{{ $entite->nom }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <p class="font-weight-bold-custom">Numéro Fiscal :</p>
                                        <p>{{ $entite->numero_fiscal }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <p class="font-weight-bold-custom">Adresse :</p>
                                        <p>{{ $entite->adresse }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <p class="font-weight-bold-custom">Pays :</p>
                                        <p>{{ $entite->pays }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <p class="font-weight-bold-custom">Contact :</p>
                                        <p>{{ $entite->contact }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <p class="font-weight-bold-custom">Numéro SIRET :</p>
                                        <p>{{ $entite->numero_siret }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <p class="font-weight-bold-custom">Code APE/NAF :</p>
                                        <p>{{ $entite->code_ape_naf }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <p class="font-weight-bold-custom">Convention Collective :</p>
                                        <p>{{ $entite->convention_collective }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <p class="font-weight-bold-custom">Identifiant de l’établissement :</p>
                                        <p>{{ $entite->identifiant_etablissement }}</p>
                                    </div>
                                </div>
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
