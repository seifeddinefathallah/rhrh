<div class="container my-4">
    <div class="row">
        <div class="col-md-12">
    <input type="text" wire:model.debounce.300ms="searchTerm" placeholder="chercher entities avec nom ou autre critère" class="form-control form-control-navbar" aria-label="Search" />

            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-light">
        <tr>
            <th>Image</th>
            <th>Nom</th>
            <th>Numéro Fiscal</th>
            <th>Adresse</th>
            <th>Pays</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($entites as $entite)
        <tr>
            <td>
                @if ($entite->image)
                <img src="{{ asset('storage/' . $entite->image) }}" class="img-thumbnail" style="width: 80px; height: 80px;">
                @else
                <img src="https://via.placeholder.com/80" class="img-thumbnail" style="width: 80px; height: 80px;">
                @endif
            </td>
            <td>{{ $entite->nom }}</td>
            <td>{{ $entite->numero_fiscal }}</td>
            <td>{{ $entite->adresse }}</td>
            <td>{{ $entite->pays }}</td>
            <td>
                <a href="{{ route('entites.show', $entite->id) }}" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-eye"></i>
                </a>
                <a href="{{ route('entites.edit', $entite->id) }}" class="btn btn-outline-success btn-sm">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="{{ route('entites.destroy', $entite->id) }}" method="POST" class="d-inline">
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
