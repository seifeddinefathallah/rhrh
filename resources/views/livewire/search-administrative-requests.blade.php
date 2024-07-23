<div class="container my-4">
    <div class="row">
        <div class="col-md-12">
    <input type="text" wire:model.debounce.300ms="searchTerm" placeholder="Chercher par nom ou prénom de l'employé" class="form-control mb-3" aria-label="Search" />

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-light">
        <tr>
            <th>Employé</th>
            <th>Type</th>
            <th>Statut</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($requests as $request)
        <tr>
            <td>
                @if ($request->employee)
                {{ $request->employee->prenom }} {{ $request->employee->nom }}
                @else
                N/A
                @endif
            </td>
            <td>{{ $request->type }}</td>
            <td>
                @if ($request->status === 'En attente' || $request->status === 'en_attente')
                <span class="badge bg-warning text-dark">{{ ucfirst($request->status) }}</span>
                @elseif ($request->status === 'approuvé')
                <span class="badge bg-success text-light">{{ ucfirst($request->status) }}</span>
                @elseif ($request->status === 'rejeté')
                <span class="badge bg-danger text-light">{{ ucfirst($request->status) }}</span>
                @endif
            </td>
            <td>
                <a href="{{ route('requests.edit', $request->id) }}" class="btn btn-outline-success btn-sm">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="{{ route('requests.destroy', $request->id) }}" method="POST" class="d-inline">
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
                event.preventDefault(); // Prevent the default form submission
                const form = this; // Reference to the form

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Submit the form if confirmed
                    } else {
                        Swal.fire(
                            'Cancelled',
                            'Your request is safe :)',
                            'error'
                        );
                    }
                });
            });
        });
    });
</script>

