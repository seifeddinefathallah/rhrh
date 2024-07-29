<div class="container my-4">
    <div class="row">
        <div class="col-md-12">

            <input type="text" wire:model.debounce.300ms="search" placeholder="chercher par employee" class="form-control form-control-navbar" aria-label="Search" />
    <table class="table table-striped">
        <thead>
        <tr>

            <th>Employee</th>
            <th>Item Name</th>
            <th>Quantity</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($requests as $request)
            <tr>

                <td>{{ $request->employee ? $request->employee->prenom . ' ' . $request->employee->nom : 'N/A' }}</td>
                <td>{{ $request->item_name }}</td>
                <td>{{ $request->quantity }}</td>
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
                    <a href="{{ route('supply_requests.show', $request->id) }}" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('supply_requests.edit', $request->id) }}" class="btn btn-outline-success btn-sm">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('supply_requests.destroy', $request->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm delete-btn">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                    <form action="{{ route('supply_requests.approve', $request->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-outline-success btn-sm approve-btn" onclick="confirmApprove(event)" title="Approve"><i class="fas fa-check-circle"></i></button>
                    </form>
                    <form action="{{ route('supply_requests.reject', $request->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-outline-danger btn-sm reject-btn" title="Reject" onclick="confirmReject(event)"><i class="fas fa-times-circle"></i></button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">No results found.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{ $requests->links() }}
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
        <script>
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
