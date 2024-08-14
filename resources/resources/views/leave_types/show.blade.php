<!-- resources/views/leave_types/show.blade.php -->

@extends('layouts.app')

@section('content')
<div class="layout-container" style="layout-container max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class=" container-xxl flex-grow-1 container-p-y">  
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">Détails du Type de Congé</h2>
        <dl class="row">
            <dt class="col-sm-3">Nom</dt>
            <dd class="col-sm-9">{{ $leaveType->name }}</dd>

            <dt class="col-sm-3">Nombre Maximum de Jours</dt>
            <dd class="col-sm-9">{{ $leaveType->max_days }}</dd>

            <dt class="col-sm-3">Nécessite un Certificat Médical</dt>
            <dd class="col-sm-9">{{ $leaveType->requires_medical_certificate ? 'Oui' : 'Non' }}</dd>
        </dl>
        <div class="mt-4 d-flex justify-content-end gap-2 float-end"> 
        <a href="{{ route('leave_types.index') }}" class="btn btn-secondary">Retour à la Liste</a>
        </div>
    </div>
</div>
</div>
@endsection
