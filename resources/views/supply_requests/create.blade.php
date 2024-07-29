@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Supply Request</h1>
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
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
