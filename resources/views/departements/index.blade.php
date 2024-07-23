@extends('layouts.app')

@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        Liste des départements
                    </h2>
                    @if(session('success'))
                    <div class="bg-green-200 border border-green-200 text-black-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Success!</strong>
                        <ul>{{ session('success') }}</ul>
                    </div>
                    @endif
                    <a href="{{ route('departements.create') }}" class="btn btn-primary mb-3">Ajouter un département</a>
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    @livewire('departement-search')
                </div>

            </div>
        </div>
    </div>
@endsection
