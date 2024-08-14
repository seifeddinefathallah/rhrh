<!-- resources/views/leave_types/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="layout-container" style="layout-container max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class=" container-xxl flex-grow-1 container-p-y">  
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">Créer un Nouveau Type de Congé</h2>
        <form action="{{ route('leave_types.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Nom du Type de Congé</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <div class="form-group">
                <label for="max_days">Nombre Maximum de Jours</label>
                <input type="number" name="max_days" id="max_days" class="form-control @error('max_days') is-invalid @enderror" value="{{ old('max_days') }}">
                @error('max_days')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="requires_medical_certificate">Nécessite un Certificat Médical</label>
                <input type="checkbox" name="requires_medical_certificate" id="requires_medical_certificate" value="1" {{ old('requires_medical_certificate') ? 'checked' : '' }}>
                @error('requires_medical_certificate')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-4 d-flex justify-content-end gap-2 float-end"> 
            <button type="submit" class="btn btn-primary">Créer</button>
            <a href="{{ route('leave_types.index') }}" class="btn btn-secondary">Retour à la Liste</a>
            </div>
        </form>
    </div>
    </div>
</div>
@endsection
