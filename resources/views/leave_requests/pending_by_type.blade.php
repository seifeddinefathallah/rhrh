<!-- resources/views/leave_requests/pending_by_type.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="layout-container max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                 <h2>Demandes de congé en attente pour {{ $name }}</h2>
                    <input type="text" wire:model="search" placeholder="Search by employee name or leave type..." class="form-control mb-4" />

        @if ($leaveRequests->isEmpty())
            <p>Aucune demande de congés trouvée.</p>
        @else
            <table class="table">
                <thead>
                <tr>
                    <th>Employé</th>
                    <th>Type de Congé</th>
                    <th>Date de Début</th>
                    <th>Date de Fin</th>
                    <th>Motif</th>
                    <th>Certificat Médical</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($leaveRequests as $request)
                    <tr>
                        <td>{{ $request->employee->prenom ?? 'Inconnu' }} {{ $request->employee->nom ?? 'Inconnu' }}</td>
                        <td>{{ $request->leaveType->name ?? 'Inconnu' }}</td>
                        <td>{{ $request->start_date->format('d/m/Y') }}</td>
                        <td>{{ $request->end_date->format('d/m/Y') }}</td>
                        <td>{{ $request->reason }}</td>
                        <td>
                            @if ($request->medical_certificate)
                                <a href="{{ Storage::url($request->medical_certificate) }}" target="_blank" class="btn btn-info btn-sm">Voir Certificat</a>
                            @elseif ($request->certificate_upload_deadline)
                                <div class="countdown" data-deadline="{{ $request->certificate_upload_deadline->toIso8601String() }}"></div>
                            @else
                                Pas de certificat
                            @endif
                        </td>
                        <td>
                            @if($request->status === 'pending')
                                <span class="badge bg-label-warning me-1">{{ ucfirst($request->status) }}</span>
                            @elseif($request->status === 'approved')
                                <span class="badge bg-label-success me-1">{{ ucfirst($request->status) }}</span>
                            @elseif($request->status === 'rejected')
                                <span class="badge bg-label-danger">{{ ucfirst($request->status) }}</span>
                            @else
                                <span>{{ ucfirst($request->status) }}</span>
                            @endif
                        </td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded text-primary"></i>
                                </button>
                                <div class="dropdown-menu">
                                    @if ($request->status === 'pending')
                                        <a class="dropdown-item" href="{{ route('leave_requests.edit', $request->id) }}">
                                            <i class="bx bx-edit-alt me-1 text-warning"></i> Modifier
                                        </a>
                                    @endif
                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $request->id }}">
                                        <i class="bx bx-trash me-1 text-danger"></i> Supprimer
                                    </a>
                                    @if ($request->status === 'pending')
                                        <a class="dropdown-item" href="#" onclick="confirmApprove(event, {{ $request->id }});">
                                            <i class="bx bx-check-circle me-1 text-success"></i> Approuver
                                        </a>
                                        <a class="dropdown-item" href="#" onclick="confirmReject(event, {{ $request->id }});">
                                            <i class="bx bx-x-circle me-1 text-danger"></i> Rejeter
                                        </a>
                                    @endif
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
                                            <form action="{{ route('leave_requests.destroy', $request->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Supprimer définitivement</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Approve and Reject forms -->
                            <form id="approve-form-{{ $request->id }}" action="{{ route('leave_requests.approve', $request->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('PUT')
                            </form>

                            <form id="reject-form-{{ $request->id }}" action="{{ route('leave_requests.reject', $request->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('PUT')
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
        </div>
        </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.countdown').forEach(function(element) {
                var deadline = new Date(element.getAttribute('data-deadline'));

                var countdown = function() {
                    var now = new Date();
                    var timeRemaining = deadline - now;

                    if (timeRemaining <= 0) {
                        element.innerHTML = 'Le délai est écoulé.';
                        return;
                    }

                    var hours = Math.floor((timeRemaining / (1000 * 60 * 60)) % 24);
                    var minutes = Math.floor((timeRemaining / (1000 * 60)) % 60);
                    var seconds = Math.floor((timeRemaining / 1000) % 60);

                    element.innerHTML =
                        'Temps restant : ' +
                        hours + ' heures ' +
                        minutes + ' minutes ' +
                        seconds + ' secondes';
                };

                setInterval(countdown, 1000);
                countdown();
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmApprove(event, id) {
            event.preventDefault(); // Prevent the default link action

            Swal.fire({
                title: 'Êtes-vous sûr ?',
                text: "Vous voulez approuver cette demande ! 👍",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, approuver!',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('approve-form-' + id).submit();
                    Swal.fire({
                        title: 'Approuvé!',
                        text: 'La demande a été approuvée.',
                        icon: 'success',
                        confirmButtonColor: '#28a745',
                    });
                }
            });
        }

        function confirmReject(event, id) {
            event.preventDefault();
            Swal.fire({
                title: 'Êtes-vous sûr ?',
                text: "Vous voulez rejeter cette demande ! ❌",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, rejeter!',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('reject-form-' + id).submit();
                    Swal.fire({
                        title: 'Rejeté!',
                        text: 'La demande a été rejetée.',
                        icon: 'success',
                        confirmButtonColor: '#dc3545',
                    });
                }
            });
        }
    </script>
@endsection
