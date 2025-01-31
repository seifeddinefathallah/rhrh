<!-- resources/views/leave_requests/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">Détails de la Demande de Congé</h2>
        <dl class="row">
            <dt class="col-sm-3">Type de Congé</dt>
            <dd class="col-sm-9">{{ $leaveRequest->leaveType->name }}</dd>

            <dt class="col-sm-3">Date de Début</dt>
            <dd class="col-sm-9">{{ $leaveRequest->start_date->format('d/m/Y') }}</dd>

            <dt class="col-sm-3">Date de Fin</dt>
            <dd class="col-sm-9">{{ $leaveRequest->end_date->format('d/m/Y') }}</dd>

            <dt class="col-sm-3">Motif</dt>
            <dd class="col-sm-9">{{ $leaveRequest->reason }}</dd>

            @if ($leaveRequest->medical_certificate)
                <dt class="col-sm-3">Certificat Médical</dt>
                <dd class="col-sm-9">
                    <a href="{{ asset('storage/' . $leaveRequest->medical_certificate) }}" target="_blank">Voir le certificat</a>
                </dd>
            @endif
        </dl>
        <div class="mt-4 d-flex justify-content-end gap-2 float-end"> 
        <a href="{{ route('leave_requests.index') }}" class="btn btn-secondary">Retour à la Liste</a>
        </div>
    </div>
@endsection
