@extends('layouts.app')

@section('content')
<div class="layout-container" style="width: 85%; position: relative; left: 16%;">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">
            {{ __('Liste des demandes administratives') }}
        </h2>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
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
                            <th>Employé</th>
                            <th>Type</th>
                            <th>Statut</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($requests as $request)
                        <tr>
                            <td>{{ $request->employee->prenom }} {{ $request->employee->nom }}</td>
                            <td>{{ $request->type }}</td>
                            <td>
                                @if ($request->status === 'En attente')
                                    <span class="badge bg-label-warning me-1">{{ $request->status }}</span>
                                @elseif ($request->status === 'rejeté')
                                    <span class="badge bg-label-danger me-1">{{ $request->status }}</span>
                                @elseif ($request->status === 'approuvé')
                                    <span class="badge bg-label-success me-1">{{ $request->status }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded text-primary"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('requests.edit', $request->id) }}">
                                            <i class="bx bx-edit-alt me-1 text-warning"></i> Modifier
                                        </a>
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $request->id }}">
                                            <i class="bx bx-trash me-1 text-danger"></i> Supprimer
                                        </a>
                                    </div>
                                </div>
                            
                                <!-- Modal de confirmation pour la suppression -->
                                <div class="modal fade" id="deleteModal{{ $request->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $request->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $request->id }}">Confirmer la suppression</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="alert alert-danger alert-dismissible">
                                                Êtes-vous sûr de vouloir supprimer cette demande ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                <form action="{{ route('requests.destroy', $request->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Supprimer définitivement</button>
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
  <!-- Create Button Aligned to the Right -->
  <div class="mb-3 text-end">
    <a href="{{ route('requests.create') }}" class="btn btn-primary float-end">
        {{ __('Créer la demande') }}
    </a>
</div>
                {{ $requests->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
