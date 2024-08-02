@extends('layouts.app')

@section('content')
<div class="layout-container" style="width: 85%; position: relative; left: 16%;">
    <div class="container-xxl flex-grow-1 container-p-y">  
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> 
           
            <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">
                {{ __('Détails du Département') }}
            </h2>
            <div class="p-6 bg-white border-b border-gray-200">
                <!-- Informations du Département -->
                <div class="row">
                    <div class="col-xl">
                        <div class="card mb-4">
                            <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label"><strong>Nom du Département:</strong></label>
                            <p>{{ $departement->nom }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>Entité:</strong></label>
                        @foreach ($departement->entites as $entite)
                        <span class="badge bg-label-success">{{ $entite->nom }}</span>
                    @endforeach
                </div> 
                    </div>
                </div>

                <!-- Bouton de retour -->
                <div class="mt-4">
                    <a href="{{ route('departements.index') }}" class="btn btn-primary float-end">Retour à la liste</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
