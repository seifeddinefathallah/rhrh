   @extends('layouts.app')

    @section('content')
      
    <div class="layout-container" style="width: 85%; position: relative; left: 16%;">
            <div class=" container-xxl flex-grow-1 container-p-y">  
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
               
        <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">
            {{ __('Liste des entités') }}
        </h2>
                <div class="p-6 bg-white border-b border-gray-200">
                  

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

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Numéro Fiscal</th>
                            <th>Adresse</th>
                            <th>Pays</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($entites as $entite)
                        <tr>
                            <td>{{ $entite->nom }}</td>
                            <td>{{ $entite->numero_fiscal }}</td>
                            <td>{{ $entite->adresse }}</td>
                            <td>{{ $entite->pays }}</td>
                          

                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded text-primary"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('entites.show', $entite->id)}}">
                                            <i class="bx bx-show me-1 text-success"></i> Show
                                        </a>
                                        <a class="dropdown-item" href="{{ route('entites.edit', $entite->id) }}">
                                            <i class="bx bx-edit-alt me-1 text-warning"></i> Edit
                                        </a>
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $entite->id }}">
                                            <i class="bx bx-trash me-1 text-danger"></i> Delete
                                        </a>
                                    </div>
                                </div>
                            
                                <!-- Modal -->
                                <div class="modal fade" id="deleteModal{{ $entite->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $entite->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $entite->id }}">Confirm Delete</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="alert alert-danger">
                                                    Are you sure you want to delete this entite?
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <form action="{{ route('entites.destroy', $entite->id) }}" method="POST">
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
                    <div class="mb-3">
                    <a href="{{ route('entites.create') }}" class="btn btn-primary float-end">Ajouter une nouvelle entité</a>
                </div>
                
                </div>
            </div>
        </div>
    </div>
@endsection
