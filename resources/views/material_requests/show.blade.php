@extends('layouts.app')

@section('content')
<div id="main-layout" class="layout-container" style="width: 85%; position: relative; left: 16%;">
    <div class="container-xxl flex-grow-1 container-p-y">  
        <div class="bg-white shadow-md rounded-lg">    
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
