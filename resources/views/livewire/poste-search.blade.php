<div class="container my-4">
    <div class="row">
        <div class="col-md-12">
        <input type="text" wire:model.debounce.300ms="searchTerm" placeholder="Chercher postes" class="form-control mb-3" aria-label="Search" />
        </div>

    <!-- Postes Table -->
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="table-light">
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
                <td>{{ $poste->departement->nom ?? 'N/A' }}</td>
                <td>
                    <a href="{{ route('postes.edit', $poste->id) }}" class="btn btn-outline-success btn-sm">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('postes.destroy', $poste->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce poste ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
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
