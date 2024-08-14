@extends('layouts.app')

@section('content')
<div id="main-layout" class="layout-container" style="width: 85%; position: relative; left: 16%;">
    <div class="container-xxl flex-grow-1 container-p-y">  
        <div class="bg-white shadow-md rounded-lg">
            <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">Material Requests</h2>
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
                 
               
                </div>
                @livewire('material-request-search')
            </div>  
            
            <div class="mt-4 d-flex justify-content-end gap-2">   
                <a href="{{ route('material_requests.create') }}" class="btn btn-primary float-end">Créer</a>
                <a href="{{ route('select-demande') }}" class="btn btn-secondary float-end">Retour à la liste</a>
            </div> 
        </div>
    </div>
@endsection
