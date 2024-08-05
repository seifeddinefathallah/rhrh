<div class="container my-4">
    <div class="row">
        <div class="col-md-12">
            
        <input type="text" wire:model.debounce.300ms="searchTerm" placeholder="Chercher employees par nom ou prénom" class="form-control mb-3" aria-label="Search" />


    <!-- Employee Table -->
    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Image</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email Professionnel</th>
                    <th>Matricule</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($employees as $employee)
            <tr>
                 <td>
                    <img src="{{ asset('storage/' . $employee->image) }}" class="img-thumbnail" style="width: 80px; height: 80px;" alt="{{ $employee->nom }}">
                 </td>
                 <td>{{ $employee->nom }}</td>
                 <td>{{ $employee->prenom }}</td>
                 <td>{{ $employee->email_professionnel }}</td>
                 <td>{{ $employee->matricule }}</td>
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
    
        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $employees->links('pagination::bootstrap-4')  }}
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
                    title: 'Êtes-vous sûr?',
                    text: "Vous ne pourrez pas revenir en arrière!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Oui, supprimez-le!',
                    cancelButtonText: 'Non, annuler!',
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
                            'Annulé',
                            'Votre fichier est en sécurité :)',
                            'error'
                        );
                    }
                });
            });
        });
    });
</script>

