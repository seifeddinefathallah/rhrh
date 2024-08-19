@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">Créer un événement</h2>
        <form action="{{ route('events.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="start_time">Start Time</label>
                <input type="date" name="start_time" id="start_time" class="form-control @error('start_time') is-invalid @enderror" value="{{ request()->query('start', old('start_time')) }}">
                @error('start_time')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="end_time">End Time</label>
                <input type="date" name="end_time" id="end_time" class="form-control">
            </div>
            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" name="location" id="location" class="form-control">
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <input type="text" name="type" id="type" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="employees">Select Employees</label>
                <select name="employees[]" id="employees" class="form-control" multiple>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->prenom }} {{ $employee->nom }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Save Event</button>
        </form>
    </div>
@endsection
