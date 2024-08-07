@extends('layouts.app')

@section('content')
<div id="main-layout" class="layout-container" style="width: 85%; position: relative; left: 16%;">
    <div class="container-xxl flex-grow-1 container-p-y">  
        <div class="bg-white shadow-md rounded-lg"> 
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
