@extends('layouts.app')

@section('content')
<div class="layout-container max-w-7xl mx-auto sm:px-6 lg:px-8" >
    <div class="container-xl flex-grow-1 container-p-y">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-3 bg-white border-b border-gray-200">
            <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">Créer Demande de founitures</h2>
            <form action="{{ route('supply_requests.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="item_name">Item Name</label>
                    <input type="text" class="form-control" id="item_name" name="item_name" required>
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" required>
                </div>
                <button type="submit" class="btn btn-primary float-end">Créer</button>
                <a href="{{ route('supply_requests.index') }}" class="btn btn-secondary float-end">Retour</a>
            </form>
        </div>
    </div>
</div>
@endsection
