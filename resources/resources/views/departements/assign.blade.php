
@extends('layouts.app')

@section('content') 
<div class="layout-container max-w-7xl mx-auto sm:px-6 lg:px-8" >
    <div class="container-xl flex-grow-1 container-p-y">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-3 bg-white border-b border-gray-200">

        <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">
            Assigner des entités au département "{{ $departement->nom }}"
        </h2>

<div class="container py-8">
     

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('departements.assign.entite', $departement->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="entites" class="form-label" style="color: #2f8bfb;">Sélectionner des entités</label>
                            <select name="entites[]" id="entites" class="form-control" multiple required>
                                @foreach ($entites as $entite)
                                <option value="{{ $entite->id }}">{{ $entite->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-4 d-flex justify-content-end gap-2"> 
                            <button type="submit" class="btn btn-primary">Assigner</button>
                            <a href="{{ route('departements.index') }}" class="btn btn-secondary float-end">Retour à la liste</a>
                        </div>
                      
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
