<!-- resources/views/employees/destroy.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            {{ __('Delete Employee') }}
        </div>
        <div class="card-body">
            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <p>Are you sure you want to delete employee {{ $employee->Nom }} {{ $employee->Prénom }}?</p>

                <div class="mt-4">
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <a href="{{ route('employees.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
