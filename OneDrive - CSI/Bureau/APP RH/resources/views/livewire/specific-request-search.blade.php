<div class="container my-4">
    <div class="row">
        <div class="col-md-12">
            <input type="text" wire:model.debounce.300ms="search" placeholder="Search by employee" class="form-control form-control-navbar" aria-label="Search" />
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Employee</th>
                    <th>Specific Request</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($requests as $request)
                    <tr>
                        <td>{{ $request->employee ? $request->employee->prenom . ' ' . $request->employee->nom : 'N/A' }}</td>
                        <td>{{ $request->request_type }}</td>
                        <td>{{ $request->description }}</td>
                        <td>
                            @if($request->status === 'pending')
                                <span class="badge bg-label-warning me-1">{{ ucfirst($request->status) }}</span>
                            @elseif($request->status === 'approved')
                                <span class="badge bg-label-success me-1">{{ ucfirst($request->status) }}</span>
                            @elseif($request->status === 'rejected')
                                <span class="badge bg-label-danger">{{ ucfirst($request->status) }}</span>
                            @else
                                <span>{{ ucfirst($request->status) }}</span>
                            @endif
                        </td> 
                        <!-- Approve Form -->
                            <form id="approve-form-{{ $request->id }}" action="{{ route('specific_requests.approve', $request->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('PUT')
                            </form>
                        
                            <!-- Reject Form -->
                            <form id="reject-form-{{ $request->id }}" action="{{ route('specific_requests.reject', $request->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('PUT')
                            </form>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded text-primary"></i>
                                </button>
                                <div class="dropdown-menu">
                        
                                    <!-- Show Action -->
                                    <a class="dropdown-item" href="{{ route('specific_requests.show', $request->id) }}">
                                        <i class="bx bx-show me-1 text-primary"></i> Show
                                    </a>
                        
                                    <!-- Edit Action -->
                                    <a class="dropdown-item" href="{{ route('specific_requests.edit', $request->id) }}">
                                        <i class="bx bx-edit-alt me-1 text-success"></i> Edit
                                    </a>
                        
                                    <!-- Delete Action -->
                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $request->id }}">
                                        <i class="bx bx-trash me-1 text-danger"></i> Delete
                                    </a>
                                    @if($request->status === 'pending')
                                    <!-- Approve Action -->
                                    <a class="dropdown-item" href="#" onclick="confirmApprove(event, '{{ $request->id }}')">
                                        <i class="bx bx-check-circle me-1 text-success"></i> Approve
                                    </a>
                               
                                    <!-- Reject Action -->
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
                                            <form action="{{ route('specific_requests.destroy', $request->id) }}" method="POST">
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
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No results found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            {{ $requests->links() }}
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

<script>
    function confirmApprove(event, id) {
event.preventDefault(); // Prevent the default link action

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
     document.getElementById('approve-form-' + id).submit();
     Swal.fire(
         'Approved!',
         'The request has been approved.',
         'success'
     );
 }
});
}

function confirmReject(event, id) {
event.preventDefault(); // Prevent the default link action

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

