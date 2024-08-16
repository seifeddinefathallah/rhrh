@extends('layouts.app')

@section('content')
<div class="layout-container max-w-7xl mx-auto sm:px-6 lg:px-8" >
    <div class="container-xl flex-grow-1 container-p-y">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-3 bg-white border-b border-gray-200">
                <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">
                    {{ __('Liste des demandes administratives') }}
                </h2>
                <div class="container">
                    <div class="row">
                        <div class="card-body text-center">
                            <h2>Total Requests For Each Status</h2>
                            <h5>Click On Them to See the Requests</h5>
                        </div>

                        @foreach ($statusCounts as $status => $count)
                            <div class="col-md-3 mb-3">
                                <a href="{{ route('requests.by_status', $status) }}">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <h4>{{ ucfirst($status) }}</h4>
                                            <p class="display-4">{{ $count }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>


                <!-- SweetAlert2 Notification -->

                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                    @if(session('success'))
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: "{{ session('success') }}",
                                showConfirmButton: false,
                                timer: 1500
                            });
                    @elseif(session('error'))
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: "{{ session('error') }}",
                            footer: '<a href="#">Why do I have this issue?</a>'
                        });
                    @endif
                    });
                </script>


                <!-- Actions and Search -->
                <div class="mb-4 flex justify-between items-center">

                    <livewire:search-administrative-requests />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

