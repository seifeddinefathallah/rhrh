<div class="container my-4">
    <div class="row">

        <div class="mt-4 d-flex justify-content-end gap-2">
             <a href="{{ route('intervention-requests.create') }}" class="btn btn-primary float-end">Créer</a>
                <a href="{{ route('select-demande') }}" class="btn btn-secondary float-end">Retour </a>
            </div>

        <div class="col-md-12">


            <!-- Search Form -->
            <input type="text" wire:model.debounce.300ms="search" placeholder="Chercher par nom ou prénom de l'employé" class="form-control form-control-navbar" aria-label="Search" />

            <!-- Table -->
            <table class="table table-striped">
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
                @forelse($requests as $request)
                    <tr>
                        <td>{{ $request->employee ? $request->employee->prenom . ' ' . $request->employee->nom : 'N/A' }}</td>
                        <td>{{ $request->description }}</td>
                        <td>{{ \Carbon\Carbon::parse($request->request_date)->format('d/m/Y') }}</td>
                        <td>
                            @if($request->status === 'pending')
                                <span  class="badge bg-label-warning me-1">{{ ucfirst($request->status) }}</span>
                            @elseif($request->status === 'approved')
                                <span class="badge bg-label-success me-1">{{ ucfirst($request->status) }}</span>
                            @elseif($request->status === 'rejected')
                                <span class="badge bg-label-danger">{{ ucfirst($request->status) }}</span>
                            @else
                                <span>{{ ucfirst($request->status) }}</span>
                            @endif
                        </td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded text-primary"></i>
                                </button>
                                <div class="dropdown-menu">
                                    @if($request->status === 'pending')
                                    <a class="dropdown-item" href="{{ route('intervention-requests.edit', $request->id) }}">
                                        <i class="bx bx-edit-alt me-1 text-success"></i> Edit
                                    </a>
                                    @endif
                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $request->id }}">
                                        <i class="bx bx-trash me-1 text-danger"></i> Delete
                                    </a>
                                    @if($request->status === 'pending')
                                    <a class="dropdown-item" href="#" onclick="confirmApprove(event, '{{ $request->id }}')">
                                        <i class="bx bx-check-circle me-1 text-success"></i> Approve
                                    </a>

                                    <a class="dropdown-item" href="#" onclick="confirmReject(event, '{{ $request->id }}')">
                                        <i class="bx bx-x-circle me-1 text-danger"></i> Reject
                                    </a>
                                    @endif
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
                                            <form action="{{ route('intervention-requests.destroy', $request->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Approve Form -->
                            <form id="approve-form-{{ $request->id }}" action="{{ route('intervention-requests.approve', $request->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('PATCH')
                            </form>

                            <!-- Reject Form -->
                            <form id="reject-form-{{ $request->id }}" action="{{ route('intervention-requests.reject', $request->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('PATCH')
                            </form>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Aucune demande trouvée.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            {{ $requests->links() }}
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Function for handling delete action
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('form.d-inline').forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    event.preventDefault(); // Prevent the default form submission
                    const form = this; // Reference to the form

                    Swal.fire({
                        title: 'Are you sure?🗑️',
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
                            form.submit(); // Submit the form if confirmed
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
    <script>
        // Function for handling approve action
        function confirmApprove(event, id) {
            event.preventDefault(); // Prevent the default form submission
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to approve this request! 👍",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#03c3ec',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, approve it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form
                    document.getElementById('approve-form-' + id).submit();
                    Swal.fire(
                        'Approved!',
                        'The request has been approved.',
                        'success'
                    );
                }
            });
        }

        // Function for handling reject action
        function confirmReject(event, id) {
            event.preventDefault(); // Prevent the default form submission
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to reject this request! ❌",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#03c3ec',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, reject it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form
                    document.getElementById('reject-form-' + id).submit();
                    Swal.fire(
                        'Rejected!',
                        'The request has been rejected.',
                        'success'
                    );
                }
            });
        }
    </script>
</div>
