@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Holiday</h1>

        <form action="{{ route('holidays.update', $holiday) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $holiday->name) }}" required>
                @error('name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" id="start_date" name="start_date" class="form-control" value="{{ old('start_date', $holiday->start_date->format('Y-m-d')) }}" required>
                @error('start_date')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="date" id="end_date" name="end_date" class="form-control" value="{{ old('end_date', $holiday->end_date->format('Y-m-d')) }}" required>
                @error('end_date')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('holidays.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
