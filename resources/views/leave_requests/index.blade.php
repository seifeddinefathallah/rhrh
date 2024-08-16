@extends('layouts.app')

@section('content')
    <div class="layout-container max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">Toutes les Demandes de Congés</h2>
                <a href="{{ route('leave_requests.create') }}" class="btn btn-primary mb-3">Créer une Demande</a>

                <!-- Display Total Approved Requests -->
                <div class="container">
                    <h1>Leave Requests Summary</h1>

                    <!-- Total Approved Leave Requests -->
                    <div class="card mb-3">
                        <div class="card-body text-center">
                            <h2>Total Approved</h2>
                            <p class="display-4">{{ $totalApproved }}</p>
                        </div>
                    </div>

                    <!-- Pending Leave Requests by Type -->
                    <div class="row">
                        <div class="card-body text-center">
                            <h2>Total Pending Request For Each Types</h2>
                            <h5>Click On Them to See the Request</h5>
                        </div>

                        @foreach ($pendingByTypeWithNames as $pending)
                            <div class="col-md-3 mb-3">
                                <a href="{{ route('leave_requests.pending_by_type', $pending['name']) }}">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <h4>{{ $pending['name'] }}</h4>
                                            <p class="display-4">{{ $pending['total'] }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

                @livewire('leave-request-search')

            </div>
        </div>
    </div>

    <style>
        .custom-card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .custom-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .custom-card h4 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #03428e;
        }

        .custom-card p {
            font-size: 2.5rem;
            font-weight: 700;
            color: #03428e;
        }

        .container > h1 {
            margin-bottom: 1.5rem;
            font-size: 2rem;
            font-weight: bold;
            color: #03428e;
            text-align: center;
        }
    </style>
@endsection
