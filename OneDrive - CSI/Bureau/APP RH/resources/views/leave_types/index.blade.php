<!-- resources/views/leave_types/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="layout-container" style="layout-container max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class=" container-xxl flex-grow-1 container-p-y">  
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">Types de Congés</h2>
        <a href="{{ route('leave_types.create') }}" class="btn btn-primary mb-3">Créer un Nouveau Type de Congé</a>

        @if ($leaveTypes->isEmpty())
            <p>Aucun type de congé trouvé.</p>
        @else
            <table class="table">
                <thead>
                <tr>
                    <th>Nom</th>
                    <th>Max Jours</th>
                    <th>Certificat Médical Nécessaire</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($leaveTypes as $type)
                    <tr>
                        <td>{{ $type->name }}</td>
                        <td>{{ $type->max_days }}</td>
                        <td>
                            {{ $type->requires_medical_certificate ? 'Oui' : 'Non' }}
                        </td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded text-primary"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('leave_types.show', $type) }}">
                                        <i class="bx bx-show me-1 text-info"></i> Afficher
                                    </a>
                                    <a class="dropdown-item" href="{{ route('leave_types.edit', $type) }}">
                                        <i class="bx bx-edit-alt me-1 text-warning"></i> Modifier
                                    </a>
                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $type->id }}">
                                        <i class="bx bx-trash me-1 text-danger"></i> Supprimer
                                    </a>
                                </div>
                            </div>

                            <!-- Modal de confirmation pour la suppression -->
                            <div class="modal fade" id="deleteModal{{ $type->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $type->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $type->id }}">Confirmer la suppression</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Êtes-vous sûr de vouloir supprimer ce type de congé ?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                            <form action="{{ route('leave_types.destroy', $type) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
