@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Material Request Details</h1>
        <p><strong>Material Name:</strong> {{ $materialRequest->material_name }}</p>
        <p><strong>Description:</strong> {{ $materialRequest->description }}</p>
        <p><strong>Quantity:</strong> {{ $materialRequest->quantity }}</p>
        <p><strong>Status:</strong> {{ $materialRequest->status }}</p>
    </div>
@endsection
