<!-- resources/views/employees/index.blade.php -->

@extends('layouts.app')

@section('content')


<!-- Wrapper pour gérer la logique de barre latérale -->
<div x-data="{ open: true }">
   
  
    <!-- Conteneur principal avec classes dynamiques -->
    <div class="layout-container" style="width: 85%; position: relative; left: 16%;">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 bg-white border-b border-gray-200">
                    
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
                    <div class="overlay-effect bg-gray-700 bg-opacity-50 fixed inset-0 z-50 transition-opacity duration-300" x-show="open" @click.away="open = false"></div>

                    <div class="mb-4">
                        <form action="{{ route('employees.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <button type="submit" class="btn btn-secondary">Import Employees</button>
                        </form>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Date de naissance</th>
                                    <th>Email professionnel</th>
                                    <th>Email personnel</th>
                                    <th>Matricule</th>
                                    <th>Téléphone</th>
                                    <th>Adresse</th>
                                    <th>Code postal</th>
                                    <th>Ville</th>
                                    <th>Pays</th>
                                    <th>Situation familiale</th>
                                    <th>Nombre d'enfants</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($employees as $employee)
                            <tr>
                                <td>{{ $employee->id }}</td>
                                <td>{{ $employee->nom }}</td>
                                <td>{{ $employee->prenom }}</td>
                                <td>{{ $employee->date_naissance }}</td>
                                <td>{{ $employee->email_professionnel }}</td>
                                <td>{{ $employee->email_personnel }}</td>
                                <td>{{ $employee->matricule }}</td>
                                <td>{{ $employee->telephone }}</td>
                                <td>{{ $employee->adresse }}</td>
                                <td>{{ $employee->code_postal }}</td>
                                <td>{{ $employee->ville }}</td>
                                <td>{{ $employee->pays }}</td>
                                <td>{{ $employee->situation_familiale }}</td>
                                <td>{{ $employee->nombre_enfants }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded text-primary"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('employees.show', $employee->id) }}">
                                                <i class="bx bx-show-alt me-1 text-info"></i> Show
                                            </a>
                                            <a class="dropdown-item" href="{{ route('employees.edit', $employee->id) }}">
                                                <i class="bx bx-edit-alt me-1 text-warning"></i> Edit
                                            </a>
                                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $employee->id }}">
                                                <i class="bx bx-trash me-1 text-danger"></i> Delete
                                            </a>
                                        </div>
                                    </div>
                                
                                    <!-- Modal -->
                                    <div class="modal fade" id="deleteModal{{ $employee->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $employee->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $employee->id }}">Confirm Delete</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="alert alert-danger">
                                                        <p>Are you sure you want to delete this employee?</p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST">
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
                    </div>
                    @if (session('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                    @endif
                </div>
                <div class="mb-4 d-flex justify-content-end">
                    <a href="{{ route('employees.create') }}" class="btn btn-primary">Create Employee</a>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
