@extends('layouts.app')

@section('content')
    <div class="layout-container" style="width: 85%; position: relative; left: 16%;">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Créer une demande administrative') }}
                    </h2>

                    <form action="{{ route('requests.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="employee_name" value="{{ $employee->nom }}" readonly>
                            <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                        </div>
                        <div class="mb-4">
                            <label for="type" class="block text-sm font-medium text-gray-700">Type de demande</label>
                            <select name="type" id="type" class="form-select mt-1 block w-full">
                                @foreach (\App\Models\AdministrativeRequest::TYPES as $type)
                                    <option value="{{ $type }}">{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Créer la demande</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
