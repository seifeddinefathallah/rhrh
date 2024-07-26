<!-- resources/views/intervention-requests/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Modifier la Demande d'Intervention</h1>

        <form action="{{ route('intervention-requests.update', $interventionRequest) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" required>{{ old('description', $interventionRequest->description) }}</textarea>
                @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="request_date">Date</label>
                <input type="date" name="request_date" id="request_date" class="form-control" value="{{ old('request_date', $interventionRequest->request_date instanceof \Carbon\Carbon ? $interventionRequest->request_date->format('Y-m-d') : '') }}" required>
                @error('request_date')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="status">Statut</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="pending" {{ old('status', $interventionRequest->status) == 'pending' ? 'selected' : '' }}>En attente</option>
                    <option value="approved" {{ old('status', $interventionRequest->status) == 'approved' ? 'selected' : '' }}>Approuvée</option>
                    <option value="rejected" {{ old('status', $interventionRequest->status) == 'rejected' ? 'selected' : '' }}>Rejetée</option>
                </select>
                @error('status')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Sauvegarder</button>
            <a href="{{ route('intervention-requests.index') }}" class="btn btn-secondary">Retour</a>
        </form>
    </div>
@endsection
