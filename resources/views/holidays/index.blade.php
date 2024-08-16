<!-- resources/views/holidays/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Holidays</h1>
        <a href="{{ route('holidays.create') }}" class="btn btn-primary">Add Holiday</a>

        <table class="table mt-4">
            <thead>
            <tr>
                <th>Name</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($holidays as $holiday)
                <tr>
                    <td>{{ $holiday->name }}</td>
                    <td>{{ $holiday->start_date->format('d/m/Y') }}</td>
                    <td>{{ $holiday->end_date->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('holidays.edit', $holiday) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('holidays.destroy', $holiday) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
