  @extends('layouts.app')

        @section('content')

        <div class="layout-container max-w-7xl mx-auto sm:px-6 lg:px-8" >
            <div class="container-xl flex-grow-1 container-p-y">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-3 bg-white border-b border-gray-200">

                <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">
            {{ __('Les demandes Prét Avances') }}
        </h2>
                        <div class="container">
                            <div class="row">
                                <!-- Display total approved requests -->
                                <div class="col-md-12 mb-3">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <h2>Total Approved Requests</h2>
                                            <p class="display-4">{{ $approvedCount }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Display pending requests by type -->
                                <div class="col-md-12 mb-3">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <h2>Total Pending Loan Requests For Each Type</h2>
                                            <h5>Click On Them to See the Requests</h5>
                                        </div>
                                    </div>
                                </div>

                                @foreach ($pendingByType as $type => $total)
                                    <div class="col-md-3 mb-3">
                                        <a href="{{ route('loan_requests.pending_by_type', ['type' => urlencode($type)]) }}">
                                            <div class="card">
                                                <div class="card-body text-center">
                                                    <h4>{{ $type }}</h4>
                                                    <p class="display-4">{{ $total }}</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach

                    @if ($message = Session::get('success'))
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            Swal.fire({
                                position: 'bottom-end',
                                icon: "success",
                                title: "{{ session('success') }}",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        });
                    </script>
                    @endif

                @livewire('loan-request-search')


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
