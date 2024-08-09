<!-- resources/views/leave_types/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Détails du Type de Congé</h1>
        <dl class="row">
            <dt class="col-sm-3">Nom</dt>
            <dd class="col-sm-9">{{ $leaveType->name }}</dd>

            <dt class="col-sm-3">Nombre Maximum de Jours</dt>
            <dd class="col-sm-9">{{ $leaveType->max_days }}</dd>

            <dt class="col-sm-3">Nécessite un Certificat Médical</dt>
            <dd class="col-sm-9">{{ $leaveType->requires_medical_certificate ? 'Oui' : 'Non' }}</dd>
        </dl>

        <a href="{{ route('leave_types.index') }}" class="btn btn-secondary">Retour à la Liste</a>
    </div>
@endsection
