<div class="container my-4">
    <div class="row">
        <div class="col-md-12">
    <input type="text" wire:model.debounce.300ms="searchTerm" placeholder="chercher entities avec nom ou autre critère" class="form-control form-control-navbar" aria-label="Search" />

            <div class="table-responsive">
             
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Image</th>
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
                        <td>
                            @if ($entite->image)
                                <img src="{{ asset('storage/' . $entite->image) }}" alt="Image de l'entité" style="width: 100px; height: auto;">
                            @else
                                Pas d'image
                            @endif
                        </td>
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

    <!-- Pagination Links -->
    {{ $entites->links() }}
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
