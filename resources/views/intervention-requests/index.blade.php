@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
        <h1>Demandes d'Interventions</h1>
        <a href="{{ route('intervention-requests.create') }}" class="btn btn-primary">Ajouter une demande</a>
        @livewire('intervention-request-search')
    </div>
@endsection
