@extends('layouts.app')

@section('content')
<div class="layout-container" style="width: 85%; position: relative; left: 16%;">
    <div class=" container-xxl flex-grow-1 container-p-y">  
        
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modifier le département
        </h2>
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('departements.update', $departement->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom du département</label>
                            <input type="text" name="nom" id="nom" class="form-control" value="{{ $departement->nom }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Modifier</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection