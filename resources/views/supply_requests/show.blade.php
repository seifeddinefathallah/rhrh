@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Supply Request Details</h1>
        <p><strong>Item Name:</strong> {{ $supplyRequest->item_name }}</p>
        <p><strong>Quantity:</strong> {{ $supplyRequest->quantity }}</p>
        <p><strong>Status:</strong> {{ $supplyRequest->status }}</p>
        <a href="{{ route('supply_requests.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
@endsection
