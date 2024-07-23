<div class="container my-4">
    <div class="row">
        <div class="col-md-12">
            <input type="text" wire:model.debounce.300ms="search" placeholder="Search departments" class="form-control mb-3" aria-label="Search departments">

            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-light">
                    <tr>
                        <th>Nom</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($departements as $departement)
                    <tr>
                        <td>{{ $departement->nom }}</td>
                        <td class="text-nowrap">
                            <!-- Edit Icon -->
                            <a href="{{ route('departements.edit', $departement->id) }}" class="btn btn-outline-primary btn-sm" aria-label="Edit">
                                <i class="fas fa-edit"></i>
                            </a>

                            <!-- Delete Icon -->
                            <form action="{{ route('departements.destroy', $departement->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce département ?')" aria-label="Delete">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>

                            <!-- Assign Entities Icon -->
                            <a href="{{ route('departements.assign.entite.form', $departement->id) }}" class="btn btn-outline-success btn-sm" aria-label="Assign Entities">
                                <i class="fas fa-plus"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2" class="text-center">Aucun département trouvé</td>
                    </tr>
                    @endforelse
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
