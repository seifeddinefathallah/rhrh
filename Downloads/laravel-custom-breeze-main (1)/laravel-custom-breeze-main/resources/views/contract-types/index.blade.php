@extends('layouts.app')

@section('content')
<div class="layout-container" style="width: 85%; position: relative; left: 16%;">
    <div class="container-xxl flex-grow-1 container-p-y">  
        
      
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

        <!-- Formulaire de recherche -->
        <div class="row mt-3 justify-content-center">
            <div class="col-md-6">
                <form action="{{ route('contract-types.search') }}" method="GET" id="searchForm">
                    <div class="input-group">
                        <input type="text" name="search" id="searchInput" class="form-control" placeholder="Search" value="{{ $search ?? '' }}">
                    </div>
                </form>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-lg-12 margin-tb">
                <div class="card bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="card-header text-center" style="color: #03428e;">
                        Contract Types
                    </div>
                    
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Country</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contractTypes as $contractType)
                                    <tr>
                                        <td>{{ $contractType->name }}</td>
                                        <td>{{ $contractType->description }}</td>
                                        <td>{{ $contractType->country }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded text-primary"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('contract-types.show', $contractType->id) }}">
                                                        <i class="bx bx-show me-1 text-success"></i> Show
                                                    </a>
                                                    <a class="dropdown-item" href="{{ route('contract-types.edit', $contractType->id) }}">
                                                        <i class="bx bx-edit-alt me-1 text-warning"></i> Edit
                                                    </a>
                                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $contractType->id }}">
                                                        <i class="bx bx-trash me-1 text-danger"></i> Delete
                                                    </a>
                                                </div>
                                            </div>
                                        
                                            <!-- Modal de confirmation pour la suppression -->
                                            <div class="modal fade" id="deleteModal{{ $contractType->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $contractType->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel{{ $contractType->id }}">Confirm Delete</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="alert alert-danger alert-dismissible">
                                                            <p>Are you sure you want to delete this contract type?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <form action="{{ route('contract-types.destroy', $contractType->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table> 

                        <!-- Create New Contract Type Button -->
                        <div class="row mt-3">
                            <div class="col-lg-12 d-flex justify-content-end">
                                <a href="{{ route('contract-types.create') }}" class="btn btn-primary">Create New Contract Type</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('searchInput').addEventListener('input', function() {
    document.getElementById('searchForm').submit();
});
</script>

@endsection
