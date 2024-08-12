@extends('layouts.app')

@section('content')
<div class="layout-container max-w-7xl mx-auto sm:px-6 lg:px-8" >
    <div class="container-xl flex-grow-1 container-p-y">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-3 bg-white border-b border-gray-200">

    <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">Details demande specifique</h2>
        <div class="card">
            <div class="card-header">
       
            </div>
            <div class="card-body">
                <h5 class="card-title" style="color: #03c3ec">{{ $specificRequest->employee->prenom . ' ' . $specificRequest->employee->nom }}</h5>
                <p class="card-text"><strong>Request Type:</strong> {{ $specificRequest->request_type }}</p>
                <p class="card-text"><strong>Description:</strong> {{ $specificRequest->description }}</p>
                <p class="card-text"><strong>Status:</strong>
                    @if($specificRequest->status === 'pending')
               <span class="badge bg-label-warning me-1">{{ ucfirst($specificRequest->status) }}</span>
           @elseif($specificRequest->status === 'approved')
               <span class="badge bg-label-success me-1">{{ ucfirst($specificRequest->status) }}</span>
           @elseif($specificRequest->status === 'rejected')
               <span class="badge bg-label-danger">{{ ucfirst($specificRequest->status) }}</span>
           @endif
                </p>
            </div>
        </div>
        <div class="mt-4"> 
          
            <a href="{{ route('specific_requests.index') }}" class="btn btn-secondary float-end">Retour</a>
        </div>
    </div>
@endsection
