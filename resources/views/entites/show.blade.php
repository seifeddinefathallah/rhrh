@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-12">
            <!-- Main Card -->
            <div class="card shadow-lg border-0 rounded-3 mb-5">
                <div class="card-header bg-dark text-white border-bottom-0">
                    <h2 class="mb-0">Informations sur l'Entité</h2>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <!-- Entity Photo -->
                        <div class="col-md-4 text-center">
                            <h4 class="font-weight-bold mb-3 text-muted">Photo</h4>
                            @if ($entite->image)
                            <img src="{{ asset('storage/' . $entite->image) }}" alt="Image de l'entité {{ $entite->nom }}" class="img-fluid rounded-3 border border-light shadow-sm" style="width: 200px; height: 200px; object-fit: cover;">
                            @else
                            <div class="alert alert-warning">Aucune image disponible</div>
                            @endif
                        </div>

                        <!-- Entity Details -->
                        <div class="col-md-8">
                            <h4 class="font-weight-bold mb-3 text-muted">Informations</h4>
                            <div class="border rounded p-4 bg-light shadow-sm">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label"><strong>Nom:</strong></label>
                                        <p>{{ $entite->nom }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label"><strong>Numéro Fiscal:</strong></label>
                                        <p>{{ $entite->numero_fiscal }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label"><strong>Adresse:</strong></label>
                                        <p>{{ $entite->adresse }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label"><strong>Pays:</strong></label>
                                        <p>{{ $entite->pays }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label"><strong>Contact:</strong></label>
                                        <p>{{ $entite->contact }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label"><strong>Nom de l'employeur:</strong></label>
                                        <p>{{ $entite->nom_employeur }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label"><strong>Adresse de l'employeur:</strong></label>
                                        <p>{{ $entite->adresse_employeur }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label"><strong>Numéro SIRET:</strong></label>
                                        <p>{{ $entite->numero_siret }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label"><strong>Code APE/NAF:</strong></label>
                                        <p>{{ $entite->code_ape_naf }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label"><strong>Convention Collective:</strong></label>
                                        <p>{{ $entite->convention_collective }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label"><strong>Identifiant de l’établissement:</strong></label>
                                        <p>{{ $entite->identifiant_etablissement }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <!-- Stylish Button -->
                        <a href="{{ route('entites.index') }}" class="btn btn-classy">
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
