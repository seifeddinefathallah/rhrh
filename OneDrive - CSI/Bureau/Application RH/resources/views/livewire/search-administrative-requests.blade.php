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
                    <span class="badge bg-label-warning me-1">{{ ucfirst($request->status) }}</span>
                @elseif ($request->status === 'approuvé')
                    <span class="badge bg-label-success me-1">{{ ucfirst($request->status) }}</span>
                @elseif ($request->status === 'rejeté')
                    <span class="badge bg-label-danger">{{ ucfirst($request->status) }}</span>
                @endif
            </td>
            <td>
                <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded text-primary"></i>
                    </button>
                    <div class="dropdown-menu">
                        
                        <!-- Edit Action -->
                        <a class="dropdown-item" href="{{ route('requests.edit', $request->id) }}">
                            <i class="fas fa-edit me-1 text-success"></i> Edit
                        </a>
            
                        <!-- Delete Action -->
                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $request->id }}">
                            <i class="fas fa-trash-alt me-1 text-danger"></i> Delete
                        </a>
                    </div>
                </div>
            
                <!-- Delete Modal -->
                <div class="modal fade" id="deleteModal{{ $request->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $request->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel{{ $request->id }}">Confirm Delete</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="alert alert-danger alert-dismissible">
                                Are you sure you want to delete this request?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <form action="{{ route('requests.destroy', $request->id) }}" method="POST">
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

