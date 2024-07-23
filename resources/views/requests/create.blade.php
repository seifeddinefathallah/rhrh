@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Créer une demande administrative') }}
                </h2>
                <form action="{{ route('requests.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="type" class="form-label">Type de demande</label>
                        <select name="type" id="type" class="form-control">
                            @foreach (\App\Models\AdministrativeRequest::TYPES as $type)
                            <option value="{{ $type }}">{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex justify-between">
                        <button type="submit" class="btn btn-primary">Créer la demande</button>
                        <a href="{{ route('requests.index') }}" class="btn btn-secondary">Retour à la liste</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
