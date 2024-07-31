<div class="container my-4">
    <div class="row">
        <div class="col-md-12">
        <input type="text" wire:model.debounce.300ms="searchTerm" placeholder="Chercher employees par nom ou prénom" class="form-control mb-3" aria-label="Search" />


    <!-- Employee Table -->
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-light">
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
                    <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-outline-success btn-sm">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm delete-btn">
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
            {{ $employees->links('pagination::bootstrap-4')  }}
        </div>
    </div>
</div>

@push('scripts')
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
@endpush
