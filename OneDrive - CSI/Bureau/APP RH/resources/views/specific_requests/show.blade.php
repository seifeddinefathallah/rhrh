@extends('layouts.app')

@section('content')
<div id="main-layout" class="layout-container" style="width: 85%; position: relative; left: 16%;">
    <div class="container-xxl flex-grow-1 container-p-y">  
        <div class="bg-white shadow-md rounded-lg">  
    <h1>View Specific Request</h1>
        <div class="card">
            <div class="card-header">
                Request Details
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $specificRequest->employee->prenom . ' ' . $specificRequest->employee->nom }}</h5>
                <p class="card-text"><strong>Request Type:</strong> {{ $specificRequest->request_type }}</p>
                <p class="card-text"><strong>Description:</strong> {{ $specificRequest->description }}</p>
                <p class="card-text"><strong>Status:</strong>
                    @if($specificRequest->status === 'pending')
                        <span style="color: orange;">{{ ucfirst($specificRequest->status) }}</span>
                    @elseif($specificRequest->status === 'approved')
                        <span style="color: green;">{{ ucfirst($specificRequest->status) }}</span>
                    @elseif($specificRequest->status === 'rejected')
                        <span style="color: red;">{{ ucfirst($specificRequest->status) }}</span>
                    @else
                        <span>{{ ucfirst($specificRequest->status) }}</span>
                    @endif
                </p>
            </div>
        </div>
    </div>
@endsection
