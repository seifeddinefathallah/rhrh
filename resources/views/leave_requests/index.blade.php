<!-- resources/views/leave_requests/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Toutes les Demandes de Congés</h1>
        <a href="{{ route('leave_requests.create') }}" class="btn btn-primary mb-3">Créer une Demande</a>
        @livewire('leave-request-search')

    </div>

@endsection
