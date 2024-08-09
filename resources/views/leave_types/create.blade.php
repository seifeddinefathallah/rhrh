<!-- resources/views/leave_types/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Créer un Nouveau Type de Congé</h1>
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

            <button type="submit" class="btn btn-primary">Créer</button>
        </form>
    </div>
@endsection
