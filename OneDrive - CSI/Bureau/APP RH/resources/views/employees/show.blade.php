@extends('layouts.app')

@section('content')

<div class="layout-container max-w-7xl mx-auto sm:px-6 lg:px-8" >
    <div class="container-xl flex-grow-1 container-p-y">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-3 bg-white border-b border-gray-200">
            <h2 class="font-semibold text-xl text-center leading-tight custom-font" style="color: #03c3ec;">
                {{ __('Details Employee') }}
            </h2>
            
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="row">
                    <!-- Informations de l'Employé -->
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h3 class="card-header" style="color: #03428e;">Informations de l'Employé</h3>
                               
                                <img src="{{ asset('storage/' . $employee->image) }}" class="img-thumbnail" style="width: 80px; height: 80px;" alt="{{ $employee->nom }}">
                               
                                <div class="mb-3">
                                    <label class="form-label"><strong>Nom:</strong></label>
                                    <p>{{ $employee->nom }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Prénom:</strong></label>
                                    <p>{{ $employee->prenom }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Date de Naissance:</strong></label>
                                    <p>{{ $employee->date_naissance }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Situation Familiale:</strong></label>
                                    <p>{{ $employee->situation_familiale }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Nombre d'Enfants:</strong></label>
                                    <p>{{ $employee->nombre_enfants }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Email Personnel:</strong></label>
                                    <p>{{ $employee->email_personnel }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Adresse -->
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h3 class="card-header" style="color: #03428e;">Adresse</h3>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Pays:</strong></label>
                                    <p>{{ $employee->pays }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Ville:</strong></label>
                                    <p>{{ $employee->state }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Cité:</strong></label>
                                    <p>{{ $employee->ville }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Code Postal:</strong></label>
                                    <p>{{ $employee->code_postal }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Adresse:</strong></label>
                                    <p>{{ $employee->adresse }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Téléphone:</strong></label>
                                    <p>{{ $employee->telephone }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Documents d'Identité -->
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h3 class="card-header" style="color: #03428e;">Documents d'Identité</h3>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Numéro CIN:</strong></label>
                                    <p>{{ $employee->cin_numero ?? 'N/A' }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Date de délivrance CIN:</strong></label>
                                    <p>{{ $employee->cin_date_delivrance }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Numéro Carte de Séjour:</strong></label>
                                    <p>{{ $employee->carte_sejour_numero }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Date de délivrance Carte de Séjour:</strong></label>
                                    <p>{{ $employee->carte_sejour_date_delivrance }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Date d'expiration Carte de Séjour:</strong></label>
                                    <p>{{ $employee->carte_sejour_date_expiration }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Type Carte de Séjour:</strong></label>
                                    <p>{{ $employee->carte_sejour_type }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Numéro de Passeport:</strong></label>
                                    <p>{{ $employee->passeport_numero }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Date de délivrance Passeport:</strong></label>
                                    <p>{{ $employee->passeport_date_delivrance }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Date d'expiration Passeport:</strong></label>
                                    <p>{{ $employee->passeport_date_expiration }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Délai de validité Passeport:</strong></label>
                                    <p>{{ $employee->passeport_delai_validite }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Informations Professionnelles -->
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h3 class="card-header" style="color: #03428e;">Informations Professionnelles</h3>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Matricule:</strong></label>
                                    <p>{{ $employee->matricule }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Email Professionnel:</strong></label>
                                    <p>{{ $employee->email_professionnel }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Entité:</strong></label>
                                    <p>{{ optional(optional(optional($employee->poste)->departement)->entite)->nom }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Département:</strong></label>
                                    <p>{{ optional(optional($employee->poste)->departement)->nom }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Poste:</strong></label>
                                    <p>{{ optional($employee->poste)->titre }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Informations du Contrat -->
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h3 class="card-header" style="color: #03428e;">Informations du Contrat</h3>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Type de Contrat:</strong></label>
                                    <p>{{ optional($employee->contractType)->description }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Date de Début du Contrat:</strong></label>
                                    <p>{{ $employee->debut_contrat }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Date de Fin du Contrat:</strong></label>
                                    <p>{{ $employee->fin_contrat }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Durée du Contrat:</strong></label>
                                    <p>{{ $employee->duree_contrat }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Bouton de retour -->
                <div class="mt-4 d-flex justify-content-end gap-2">
                    <a href="{{ route('employees.index') }}" class="btn btn-secondary">Retour à la liste</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
