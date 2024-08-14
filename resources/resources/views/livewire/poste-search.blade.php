<div class="container my-4">
    <div class="row"> 
         <div class="mb-3 custom-margin-bottom">
                <a href="{{ route('postes.create') }}" class="btn btn-primary float-end">Ajouter un poste</a>
            </div>
        <div class="col-md-12">
          
        <input type="text" wire:model.debounce.300ms="searchTerm" placeholder="Chercher postes" class="form-control mb-3" aria-label="Search" />
        </div>

    <!-- Postes Table -->
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
            
                <th>Titre</th>
                <th>Département</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($postes as $poste)
            <tr>
             
                <td>{{ $poste->titre }}</td>
                <td>{{ $poste->departement->nom }}</td>
                <td>
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded text-primary"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('postes.edit', $poste->id) }}">
                                <i class="bx bx-edit-alt me-1 text-warning"></i> Edit
                            </a>
                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $poste->id }}">
                                <i class="bx bx-trash me-1 text-danger"></i> Delete
                            </a>
                        </div>
                    </div>
                
                    <!-- Modal -->
                    <div class="modal fade" id="deleteModal{{ $poste->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $poste->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel{{ $poste->id }}">Confirm Delete</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="alert alert-danger alert-dismissible">
                                    <p>Are you sure you want to delete this poste?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <form action="{{ route('postes.destroy', $poste->id) }}" method="POST">
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
            {{ $postes->links('pagination::bootstrap-4') }}
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
<style>
    .custom-margin-bottom {
        margin-bottom: 20px; /* Ajustez selon vos besoins */
    }
</style>
