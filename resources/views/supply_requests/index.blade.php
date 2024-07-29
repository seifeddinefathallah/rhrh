@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Supply Requests</h1>
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
        <a href="{{ route('supply_requests.create') }}" class="btn btn-primary">Create New Request</a>
        @livewire('supply-search')
    </div>
@endsection
