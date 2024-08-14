<!-- resources/views/leave_requests/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="layout-container" style="layout-container max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class=" container-xxl flex-grow-1 container-p-y">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">Toutes les Demandes de Congés</h2>
        <a href="{{ route('leave_requests.create') }}" class="btn btn-primary mb-3">Créer une Demande</a>

        @livewire('leave-request-search')

@endsection
