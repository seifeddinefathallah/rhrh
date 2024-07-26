<div class="container my-4">
    <div class="row">
        <div class="col-md-12">
    <!-- Search Form -->
            <input type="text" wire:model.debounce.300ms="search" placeholder="Chercher par nom ou prénom de l'employé" class="form-control mb-3" aria-label="Search" />
    <!-- Table -->
    <table class="table">
        <thead>
        <tr>
            <th>Employé</th>
            <th>Description</th>
            <th>Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($requests as $request)
            <tr>
                <td>{{ $request->employee->nom }} {{ $request->employee->prenom }}</td>
                <td>{{ $request->description }}</td>
                <td>{{ \Carbon\Carbon::parse($request->request_date)->format('d/m/Y') }}</td>
                <td>
                    @if($request->status === 'pending')
                        <span style="color: orange;">{{ ucfirst($request->status) }}</span>
                    @elseif($request->status === 'approved')
                        <span style="color: green;">{{ ucfirst($request->status) }}</span>
                    @elseif($request->status === 'rejected')
                        <span style="color: red;">{{ ucfirst($request->status) }}</span>
                    @else
                        <span>{{ ucfirst($request->status) }}</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('intervention-requests.edit', $request->id) }}" class="btn btn-outline-success btn-sm">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('intervention-requests.destroy', $request->id) }}" method="POST" class="d-inline">
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

    <!-- Pagination -->
    {{ $requests->links() }}
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
