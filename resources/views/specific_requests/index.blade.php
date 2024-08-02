@extends('layouts.app')

@section('content')
<div id="main-layout" class="layout-container" style="width: 85%; position: relative; left: 16%;">
    <div class="container-xxl flex-grow-1 container-p-y">  
        <div class="bg-white shadow-md rounded-lg"> 
            
            <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">Specific Requests</h2>
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

       
        <div class="col-md-12">
            @livewire('specific-request-search')
        </div>

        <div class="mb-3">
          
            <a href="{{ route('specific_requests.create') }}"  class="btn btn-primary float-end">Create New Request</a>
        </div>
    </div>
@endsection
