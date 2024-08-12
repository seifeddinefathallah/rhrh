@extends('layouts.app')

@section('content')

<div class="layout-container max-w-7xl mx-auto sm:px-6 lg:px-8" >
    <div class="container-xl flex-grow-1 container-p-y">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-3 bg-white border-b border-gray-200">
        <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">
                        Modifier une demande administrative
                    </h2>
                    <!-- Form for editing administrative request -->
                    <form action="{{ route('requests.update', $request->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Form fields go here -->
                        <div class="mb-4">
                            <label for="type" class="block text-sm font-medium text-gray-700">Type de demande</label>
                            <input type="text" id="type" name="type" value="{{ $request->type }}" class="form-input rounded-md shadow-sm mt-1 block w-full" disabled>
                        </div>

                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700">Statut</label>
                            <select id="status" name="status" class="form-select rounded-md shadow-sm mt-1 block w-full">
                                <option value="en_attente" @if($request->status === 'en_attente') selected @endif>En attente</option>
                                <option value="approuvé" @if($request->status === 'approuvé') selected @endif>Approuvé</option>
                                <option value="rejeté" @if($request->status === 'rejeté') selected @endif>Rejeté</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary float-end">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
