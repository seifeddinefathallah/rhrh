<div class="container my-4">
    <div class="row">
        <div class="col-md-12">
            <input type="text" wire:model.debounce.300ms="search" placeholder="Search departments" class="form-control mb-3" aria-label="Search departments">

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                     
                            <th>Nom</th>
                            <th>Entité</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($departements as $departement)
                        <tr>
                          
                            <td>{{ $departement->nom }}</td>
                            <td>@foreach ($departement->entites as $entite)
                                <span class="badge bg-label-info">{{ $entite->nom }}</span>
                            @endforeach</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded text-primary"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('departements.show', $departement->id) }}">
                                            <i class="bx bx-show me-1 text-success"></i> Show
                                        </a>
                                        <a class="dropdown-item" href="{{ route('departements.edit', $departement->id) }}">
                                            <i class="bx bx-edit-alt me-1 text-warning"></i> Edit
                                        </a>
                                        <!-- Button to trigger modal -->
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $departement->id }}">
                                            <i class="bx bx-trash me-1 text-danger"></i> Delete
                                        </a>
                                    </div>
                                </div>
                            
                                <!-- Modal de confirmation pour la suppression -->
                                <div class="modal fade" id="deleteModal{{ $departement->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $departement->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $departement->id }}">Confirmation de la suppression</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="alert alert-danger alert-dismissible">
                                                Êtes-vous sûr de vouloir supprimer ce département ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                <form action="{{ route('departements.destroy', $departement->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            
                            <td>
                                <a href="{{ route('departements.assign.entite.form', $departement->id) }}" class="btn btn-sm btn-success">Assigner Entités</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-3">
                {{ $departements->links('pagination::bootstrap-4') }}
            </div>
        </div>
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
</script>
