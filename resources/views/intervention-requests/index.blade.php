@extends('layouts.app')

@section('content')
<div class="layout-container max-w-7xl mx-auto sm:px-6 lg:px-8" >
    <div class="container-xl flex-grow-1 container-p-y">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">




            <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">Demandes d'Interventions</h2>
            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="card bg-success text-white mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Approved Requests</h5>
                            <a href="{{ route('intervention-requests.status', 'approved') }}" class="card-text">{{ $approvedCount }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-warning text-dark mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Pending Requests</h5>
                            <a href="{{ route('intervention-requests.status', 'pending') }}" class="card-text">{{ $pendingCount }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-danger text-white mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Rejected Requests</h5>
                            <a href="{{ route('intervention-requests.status', 'rejected') }}" class="card-text">{{ $rejectedCount }}</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

        @livewire('intervention-request-search')

                </div>
    </div>
</div>
@endsection
