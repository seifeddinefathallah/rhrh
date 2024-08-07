<div class="container my-4">
    <div class="row">
        <div class="mb-4">
            <a href="{{ route('requests.create') }}" class="btn btn-primary float-end">Créer Demande</a>
        </div>
        <div class="col-md-12">
            
            <input type="text" wire:model.debounce.300ms="searchTerm" placeholder="Chercher par nom ou prénom de l'employé" class="form-control mb-3" aria-label="Search" />

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="bg-gray-50">
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
                            <td>@if ($request->employee)
                                {{ $request->employee->prenom }} {{ $request->employee->nom }}
                                @else
                                N/A
                                @endif
                            </td>
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
                            <form id="approve-form-{{ $request->id }}" action="{{ route('requests.approve', $request->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('PUT')
                            </form>
                            <form id="reject-form-{{ $request->id }}" action="{{ route('requests.reject', $request->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('PUT')
                            </form>

                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded text-primary"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <!-- <a class="dropdown-item" href="{{ route('requests.edit', $request->id) }}">
                                            <i class="bx bx-edit-alt me-1 text-warning"></i> Modifier
                                        </a> -->
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $request->id }}">
                                            <i class="bx bx-trash me-1 text-danger"></i> Supprimer
                                        </a>
                                        @if ($request->status === 'En attente')
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
            </div>
            <!-- Pagination Links -->
            <div class="mt-3">
                {{ $requests->links('pagination::bootstrap-4') }}
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
                    confirmButtonColor: '#28a745', 
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
