<!-- resources/views/leave_requests/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">Toutes les Demandes de Congés</h2>
        <a href="{{ route('leave_requests.create') }}" class="btn btn-primary mb-3 float-end">Créer une Demande</a>
        @livewire('leave-request-search')

    </div>

@endsection
