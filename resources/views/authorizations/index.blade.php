@extends('layouts.app')

@section('content')
<div class="layout-container max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-3 bg-white border-b border-gray-200">
        <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">
            {{ __('Authorization Requests') }}
        </h2>
        <div class="mb-3">
            <a href="{{ route('authorizations.create') }}" class="btn btn-primary float-end">
                {{ __('Créer une autorization') }}
            </a>
        </div>
        @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 1500
                });
            });
        </script>
        @endif

        @if(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '{{ session('error') }}',
                    footer: '<a href="#">Why do I have this issue?</a>'
                });
            });
        </script>
        @endif

        <div class="mb-4">
            <a href="{{ route('authorizations.update-temporary-balances') }}" class="btn btn-secondary">Personaliser Authorizations</a>
        </div>
                <div class="container">
                    <h1>Authorization Requests Summary</h1>

                    <!-- Total Approved Authorization Requests -->
                    <div class="card mb-3">
                        <div class="card-body text-center">
                            <h2>Total Approved</h2>
                            <p class="display-4">{{ $totalApprovedRequests }}</p>
                        </div>
                    </div>

                    <!-- Pending Authorization Requests by Type -->
                    <div class="row">
                        <div class="card-body text-center">
                            <h2>Total Pending Request For Each Type</h2>
                            <h5>Click on them to see the requests</h5>
                        </div>

                        @foreach ($pendingRequestsByType as $pending)
                            <div class="col-md-3 mb-3">
                                <a href="{{ route('authorization_requests.pending_by_type', $pending['type']) }}">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <h4>{{ $pending['type'] }}</h4>
                                            <p class="display-4">{{ $pending['total'] }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
        @livewire('authorization-search')

    </div>
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
