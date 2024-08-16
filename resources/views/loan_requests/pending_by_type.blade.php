@extends('layouts.app')

@section('content')
    <div class="layout-container max-w-7xl mx-auto sm:px-6 lg:px-8" >
        <div class="container-xl flex-grow-1 container-p-y">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-3 bg-white border-b border-gray-200">

                    <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">
                        {{ __('Demandes en attente pour le type: ') }} {{ $type }}
                    </h2>
    <!-- Blade Template -->
    <div class="container my-4">
        <div class="row">
            <div class="mb-4">
                <a href="{{ route('loan_requests.create') }}" class="btn btn-primary float-end">Créer</a>
            </div>
            <div class="col-md-12">
                <input type="text" wire:model.debounce.300ms="search" placeholder="Rechercher par nom d'employé..." class="form-control form-control-navbar" aria-label="Search" />
                <div class="table-responsive mt-4">
                    @if ($loanRequests && count($loanRequests) > 0)
                        <table class="table table-striped">
                            <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Employé</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Commentaires</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($loanRequests as $loanRequest)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($loanRequest->employee)
                                            {{ $loanRequest->employee->prenom }} {{ $loanRequest->employee->nom }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ $loanRequest->type }}</td>
                                    <td>
                                        {{ number_format($loanRequest->amount, 2) }}
                                        @if($loanRequest->currency === 'TND') TND @else € @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($loanRequest->status === 'En attente')
                                            <span class="badge bg-warning text-dark">{{ ucfirst($loanRequest->status) }}</span>
                                        @elseif ($loanRequest->status === 'Approuvé')
                                            <span class="badge bg-success text-white">{{ ucfirst($loanRequest->status) }}</span>
                                        @elseif ($loanRequest->status === 'Rejeté')
                                            <span class="badge bg-danger text-white">{{ ucfirst($loanRequest->status) }}</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $loanRequest->comments }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($loanRequest->created_at)->format('Y-m-d') }}</td>
                                    <form id="approve-form-{{ $loanRequest->id }}" action="{{ route('loan_requests.approve', $loanRequest->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('PUT')
                                    </form>
                                    <form id="reject-form-{{ $loanRequest->id }}" action="{{ route('loan_requests.reject', $loanRequest->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('PUT')
                                    </form>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded text-primary"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('loan_requests.show', $loanRequest->id) }}">
                                                    <i class="bx bx-show me-1 text-primary"></i> Voir
                                                </a>
                                                @if ($loanRequest->status === 'En attente')
                                                    <a class="dropdown-item" href="{{ route('loan_requests.edit', $loanRequest->id) }}">
                                                        <i class="bx bx-edit-alt me-1 text-warning"></i> Modifier
                                                    </a>
                                                @endif
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $loanRequest->id }}">
                                                    <i class="bx bx-trash me-1 text-danger"></i> Supprimer
                                                </a>
                                                @if($loanRequest->status === 'En attente')
                                                    <a class="dropdown-item" href="#" onclick="confirmApprove(event, '{{ $loanRequest->id }}')">
                                                        <i class="bx bx-check-circle me-1 text-success"></i> Approuver
                                                    </a>
                                                    <a class="dropdown-item" href="#" onclick="confirmReject(event, '{{ $loanRequest->id }}')">
                                                        <i class="bx bx-x-circle me-1 text-danger"></i> Rejeter
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Aucune demande trouvée.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

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
                        confirmButtonColor: '#28a745'
                    });
                }
            });
        }

        function confirmReject(event, id) {
            event.preventDefault(); // Prevent the default link action

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
                        confirmButtonColor: '#dc3545'
                    });
                }
            });
        }
    </script>
@endsection
