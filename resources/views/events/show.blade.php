
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $event->title }}</h1>
        <p><strong>Description:</strong> {{ $event->description }}</p>
        <p><strong>Start Time:</strong> {{ $event->start_time }}</p>
        <p><strong>End Time:</strong> {{ $event->end_time }}</p>
        <p><strong>Location:</strong> {{ $event->location }}</p>
        <p><strong>Type:</strong> {{ $event->type }}</p>
        <a href="{{ route('events.edit', $event->id) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
        <a href="{{ route('events.index') }}" class="btn btn-secondary">Back to Events</a>
    </div>
@endsection
