@extends('layouts.app')

@section('content')
<div class="layout-container max-w-7xl mx-auto sm:px-6 lg:px-8" >
    <div class="container-xl flex-grow-1 container-p-y">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-3 bg-white border-b border-gray-200">
            <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">Types de Contrats</h2>
            <div class="row mt-3">
                <div class="col-lg-12 d-flex justify-content-end"> 
                   <a href="{{ route('contract-types.create') }}" class="btn btn-primary">Create New Contract Type</a> 
                   
                </div>
            </div>
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
            
            @livewire('contract-type-search')
            
           
        </div>
    </div>
</div>
@endsection
