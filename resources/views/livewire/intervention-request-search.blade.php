<div class="container my-4">
    <div class="row">
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
                            <a href="{{ route('intervention-requests.edit', $request->id) }}" class="btn btn-outline-success btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('intervention-requests.destroy', $request->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm delete-btn" title="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                            <form action="{{ route('intervention-requests.approve', $request->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-outline-success btn-sm approve-btn" onclick="confirmApprove(event)" title="Approve">
                                    <i class="fas fa-check-circle"></i>
                                </button>
                            </form>
                            <form action="{{ route('intervention-requests.reject', $request->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-outline-danger btn-sm reject-btn" onclick="confirmReject(event)" title="Reject">
                                    <i class="fas fa-times-circle"></i>
                                </button>
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

        // Function for handling approve action
        function confirmApprove(event) {
            event.preventDefault(); // Prevent the default form submission

            Swal.fire({
                title: 'Are you sure?',
                text: "You want to approve this request! 👍",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, approve it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form
                    event.target.closest('form').submit();
                    Swal.fire(
                        'Approved!',
                        'The request has been approved.',
                        'success'
                    );
                }
            });
        }

        // Function for handling reject action
        function confirmReject(event) {
            event.preventDefault(); // Prevent the default form submission

            Swal.fire({
                title: 'Are you sure?',
                text: "You want to reject this request! ❌",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, reject it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form
                    event.target.closest('form').submit();
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
