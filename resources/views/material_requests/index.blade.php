@extends('layouts.app')

@section('content')
<div id="main-layout" class="layout-container" style="width: 85%; position: relative; left: 16%;">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="bg-white shadow-md rounded-lg">
            <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">Material Requests</h2>
            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="card bg-success text-white mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Demandes Approuvées</h5>
                            <a href="{{ route('material_requests.status', 'approved') }}" class="card-text">{{ $approvedCount }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-warning text-dark mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Demandes en Attente</h5>
                            <a href="{{ route('material_requests.status', 'pending') }}" class="card-text">{{ $pendingCount }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-danger text-white mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Demandes Rejetées</h5>
                            <a href="{{ route('material_requests.status', 'rejected') }}" class="card-text">{{ $rejectedCount }}</a>
                        </div>
                    </div>
                </div>
            </div>
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
