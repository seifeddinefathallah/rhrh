<div class="container my-4">
    <div class="row">
        <div class="col-md-12">
    <input type="text" wire:model.debounce.300ms="searchTerm" placeholder="Chercher par nom ou prénom de l'employé" class="form-control mb-3" aria-label="Search" />

    <div class="table-responsive">
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
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $request->id }}">
                                    <i class="bx bx-trash me-1 text-danger"></i> Supprimer
                                </a>
                                @if($request->status === 'En attente')
                                    <!-- Approve Action -->
                                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('approve-form-{{ $request->id }}').submit();">
                                        <i class="bx bx-check-circle me-1 text-success"></i> Approve
                                    </a>
                                    <!-- Reject Action -->
                                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('reject-form-{{ $request->id }}').submit();">
                                        <i class="bx bx-x-circle me-1 text-danger"></i> Reject
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

                        <form id="approve-form-{{ $request->id }}" action="{{ route('requests.approve', $request->id) }}" method="POST" style="display: none;">
                            @csrf
                            <button type="submit" class="btn btn-success">Approve</button>
                        </form>

                        <form id="reject-form-{{ $request->id }}" action="{{ route('requests.reject', $request->id) }}" method="POST" style="display: none;">
                            @csrf
                            <button type="submit" class="btn btn-danger">Reject</button>
                        </form>

                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="mb-3 text-end">
            <a href="{{ route('requests.create') }}" class="btn btn-primary float-end">
                {{ __('Créer la demande') }}
            </a>
        </div>
    </div>
    <!-- Pagination Links -->
    <div class="mt-3">
    {{ $requests->links('pagination::bootstrap-4') }}
    </div>
</div>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                document.querySelectorAll('form.d-inline').forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        event.preventDefault();
                        const form = this;

                        Swal.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Yes, delete it!',
                            cancelButtonText: 'No, cancel!',
                            reverseButtons: true,
                            customClass: {
                                confirmButton: 'btn btn-success',
                                cancelButton: 'btn btn-danger'
                            },
                            buttonsStyling: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            } else {
                                Swal.fire(
                                    'Cancelled',
                                    'Your file is safe :)',
                                    'error'
                                );
                            }
                        });
                    });
                });
            });

            function confirmApprove(event) {
                event.preventDefault();

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to approve this request! 👍",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, approve it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.target.closest('form').submit();
                        Swal.fire(
                            'Approved!',
                            'The request has been approved.',
                            'success'
                        );
                    }
                });
            }

            function confirmReject(event) {
                event.preventDefault();

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to reject this request! ❌",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, reject it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.target.closest('form').submit();
                        Swal.fire(
                            'Rejected!',
                            'The request has been rejected.',
                            'success'
                        );
                    }
                });
            }
        </script>

