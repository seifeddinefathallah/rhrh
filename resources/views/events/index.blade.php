@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Events</h1>
        <a href="{{ route('events.create') }}" class="btn btn-primary">Create Event</a>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <ul class="list-group mt-4">
            @forelse ($events as $event)
                <li class="list-group-item">
                    <h5>{{ $event->title }}</h5>
                    <p>{{ $event->description }}</p>
                    <p><strong>Start:</strong> {{ $event->start_time }} <strong>End:</strong> {{ $event->end_time }}</p>
                    <p><strong>Location:</strong> {{ $event->location }} <strong>Type:</strong> {{ $event->type }}</p>
                    <a href="{{ route('events.show', $event->id) }}" class="btn btn-info">View</a>
                    <a href="{{ route('events.edit', $event->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </li>
            @empty
                <li class="list-group-item">No events found.</li>
            @endforelse
        </ul>
    </div>
@endsection
