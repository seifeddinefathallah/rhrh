@extends('layouts.app')

@section('content')
    <div class="container my-4">
        <div class="row">
            <div class="col-md-12">
                @if(session('success'))
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: "{{ session('success') }}",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        });
                    </script>
                @endif
                <div class="d-flex justify-content-between mb-3">
                    <h2>Material Requests</h2>
                    <a href="{{ route('material_requests.create') }}" class="btn btn-primary">Create New Request</a>
                </div>
                @livewire('material-request-search')
            </div>
        </div>
    </div>
@endsection
