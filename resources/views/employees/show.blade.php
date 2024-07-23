<!-- resources/views/employees/show.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-12">
            <!-- Main Card -->
            <div class="card shadow-lg border-0 rounded-3 mb-5">
                <div class="card-header bg-dark text-white border-bottom-0">
                    <h2 class="mb-0">Détails de l'Employé</h2>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <!-- Employee Photo -->
                        <div class="col-md-4 text-center">
                            <h4 class="font-weight-bold mb-3 text-muted">Photo de Profil</h4>
                            @if ($employee->image)
                            <img src="{{ asset('storage/' . $employee->image) }}" alt="Image de l'employé {{ $employee->prenom }} {{ $employee->nom }}" class="img-fluid rounded-3 border border-light shadow-sm" style="width: 200px; height: 200px; object-fit: cover;">
                            @else
                            <div class="alert alert-warning">Aucune image disponible</div>
                            @endif
                        </div>

                        <!-- Personal Details -->
                        <div class="col-md-8">
                            <h4 class="font-weight-bold mb-3 text-muted">Informations Personnelles</h4>
                            <div class="border rounded p-4 bg-light shadow-sm">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label"><strong>Nom:</strong></label>
                                        <p>{{ $employee->nom }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label"><strong>Prénom:</strong></label>
                                        <p>{{ $employee->prenom }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label"><strong>Date de Naissance:</strong></label>
                                        <p>{{ $employee->date_naissance }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label"><strong>Email Personnel:</strong></label>
                                        <p>{{ $employee->email_personnel }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label"><strong>Téléphone:</strong></label>
                                        <p>{{ $employee->telephone }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label"><strong>Situation Familiale:</strong></label>
                                        <p>{{ $employee->situation_familiale }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label"><strong>Nombre d'Enfants:</strong></label>
                                        <p>{{ $employee->nombre_enfants }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <!-- Professional Information -->
                        <div class="col-md-6 mb-4">
                            <h4 class="font-weight-bold mb-3 text-muted">Informations Professionnelles</h4>
                            <div class="border rounded p-4 bg-light shadow-sm">
                                <div class="mb-3">
                                    <label class="form-label"><strong>Email Professionnel:</strong></label>
                                    <p>{{ $employee->email_professionnel }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Matricule:</strong></label>
                                    <p>{{ $employee->matricule }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Département:</strong></label>
                                    <p>{{ $employee->departement->nom }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Poste:</strong></label>
                                    <p>{{ $employee->poste->titre }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Solde d'Autorisation de Sortie:</strong></label>
                                    <p>{{ $employee->sortie_balance }} heures</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Solde d'Autorisation de Télétravail:</strong></label>
                                    <p>{{ $employee->teletravail_days_balance }} jours</p>
                                </div>
                            </div>
                        </div>

                        <!-- Identification Documents -->
                        <div class="col-md-6 mb-4">
                            <h4 class="font-weight-bold mb-3 text-muted">Documents d'Identification</h4>
                            <div class="border rounded p-4 bg-light shadow-sm mb-4">
                                <h5 class="font-weight-bold">Carte d'Identité Nationale (CIN)</h5>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Numéro CIN:</strong></label>
                                    <p>{{ $employee->cin_numero ?? 'N/A' }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Date de Délivrance CIN:</strong></label>
                                    <p>{{ $employee->cin_date_delivrance }}</p>
                                </div>
                            </div>

                            <div class="border rounded p-4 bg-light shadow-sm mb-4">
                                <h5 class="font-weight-bold">Passeport</h5>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Numéro de Passeport:</strong></label>
                                    <p>{{ $employee->passeport_numero }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Date de Délivrance Passeport:</strong></label>
                                    <p>{{ $employee->passeport_date_delivrance }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Date d'Expiration Passeport:</strong></label>
                                    <p>{{ $employee->passeport_date_expiration }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Délai de Validité Passeport:</strong></label>
                                    <p>{{ $employee->passeport_delai_validite }}</p>
                                </div>
                            </div>

                            <div class="border rounded p-4 bg-light shadow-sm">
                                <h5 class="font-weight-bold">Carte de Séjour</h5>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Numéro Carte de Séjour:</strong></label>
                                    <p>{{ $employee->carte_sejour_numero }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Date de Délivrance Carte de Séjour:</strong></label>
                                    <p>{{ $employee->carte_sejour_date_delivrance }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Date d'Expiration Carte de Séjour:</strong></label>
                                    <p>{{ $employee->carte_sejour_date_expiration }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Type Carte de Séjour:</strong></label>
                                    <p>{{ $employee->carte_sejour_type }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <!-- Domiciliation -->
                        <div class="col-md-12">
                            <h4 class="font-weight-bold mb-3 text-muted">Domiciliation</h4>
                            <div class="border rounded p-4 bg-light shadow-sm">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label"><strong>Pays:</strong></label>
                                        <p>{{ $employee->pays }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label"><strong>Ville:</strong></label>
                                        <p>{{ $employee->ville }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label"><strong>État/Province:</strong></label>
                                        <p>{{ $employee->state }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label"><strong>Adresse:</strong></label>
                                        <p>{{ $employee->adresse }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label"><strong>Code Postal:</strong></label>
                                        <p>{{ $employee->code_postal }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <!-- Stylish Button -->
                        <a href="{{ route('employees.index') }}" class="btn btn-classy">
                            <i class="bi bi-arrow-left-circle"></i> Retour à la liste
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('styles')
<style>
    .btn-classy {
        background: linear-gradient(135deg, #007bff, #0056b3);
        color: white;
        border: none;
        border-radius: 50px;
        padding: 10px 20px;
        font-size: 16px;
        font-weight: bold;
        text-transform: uppercase;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        transition: background 0.3s, transform 0.3s;
    }

    .btn-classy:hover {
        background: linear-gradient(135deg, #0056b3, #003d80);
        transform: scale(1.05);
    }

    .btn-classy:focus, .btn-classy:active {
        outline: none;
        box-shadow: 0 0 0 3px rgba(0,123,255,0.5);
    }
</style>
@endsection
