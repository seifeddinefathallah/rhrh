@extends('layouts.app')

@section('content')
    <form id="event-form" method="POST" action="{{ route('events.create') }}">
        @csrf
        <div>
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" required>
        </div>

        <div>
            <label for="start_time">Start Time:</label>
            <input type="date" name="start_time" id="start_time" required>
        </div>

        <div>
            <label for="end_time">End Time:</label>
            <input type="date" name="end_time" id="end_time" required>
        </div>

        <div>
            <label for="description">Description:</label>
            <textarea name="description" id="description"></textarea>
        </div>

        <div>
            <label for="location">Location:</label>
            <input type="text" name="location" id="location">
        </div>

        <div>
            <label for="type">Type:</label>
            <input type="text" name="type" id="type">
        </div>

        <div>
            <label for="employees">Select Employees:</label>
            <select name="employee_ids[]" id="employees" multiple>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit">Create Event</button>
    </form>
@endsection
