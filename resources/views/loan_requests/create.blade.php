<!-- resources/views/loan_requests/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Nouvelle demande') }}
                    </h2>
                    <form action="{{ route('loan_requests.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="type">Type de demande</label>
                            <select name="type" id="type" class="form-control" required>
                                <option value="Prêt">Prêt</option>
                                <option value="Avances">Avances</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="amount">Montant</label>
                            <input type="number" name="amount" id="amount" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="comments">Commentaires</label>
                            <textarea name="comments" id="comments" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Soumettre</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
