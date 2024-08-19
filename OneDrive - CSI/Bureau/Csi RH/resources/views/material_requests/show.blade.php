@extends('layouts.app')

@section('content')
<div class="layout-container max-w-7xl mx-auto sm:px-6 lg:px-8" >
    <div class="container-xl flex-grow-1 container-p-y">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-3 bg-white border-b border-gray-200">

    <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;"> Details demande matériel</h2>
        <p><strong>Material Name:</strong> {{ $materialRequest->material_name }}</p>
        <p><strong>Description:</strong> {{ $materialRequest->description }}</p>
        <p><strong>Quantity:</strong> {{ $materialRequest->quantity }}</p>
        <p><strong>Status:</strong> 
            
            @if($materialRequest->status === 'pending')
            <span class="badge bg-label-warning me-1">{{ ucfirst($materialRequest->status) }}</span>
        @elseif($materialRequest->status === 'approved')
            <span class="badge bg-label-success me-1">{{ ucfirst($materialRequest->status) }}</span>
        @elseif($materialRequest->status === 'rejected')
            <span class="badge bg-label-danger">{{ ucfirst($materialRequest->status) }}</span>
        @else
            <span>{{ ucfirst($materialRequest->status) }}</span>
        @endif
        
        </p>
    </div>
    <div class="mt-4"> 
        
        <a href="{{ route('material_requests.index') }}" class="btn btn-secondary float-end">Retour</a>
    </div>
@endsection
