<div class="container my-4">
    <div class="row">
        <div class="col-md-12">
    <input type="text" wire:model.debounce.300ms="search" placeholder="Rechercher par nom d'employé..." class="form-control form-control-navbar" aria-label="Search" />
            <div class="table-responsive">
                @if ($loanRequests && count($loanRequests) > 0)
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Employé
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Type
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Montant
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Statut
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Commentaires
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Date
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                    </thead>
                    <tbody >
                    @foreach ($loanRequests as $loanRequest)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($loanRequest->employee)
                                {{ $loanRequest->employee->prenom }} {{ $loanRequest->employee->nom }}
                            @else
                                N/A <!-- Display N/A or handle as per your design if employee is null -->
                            @endif
                        </td>
                        <td >
                            {{ $loanRequest->type }}
                        </td>
                        <td>
                            {{ number_format($loanRequest->amount, 2) }}
                            @if($loanRequest->currency === 'TND')
                            TND
                            @else
                            €
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($loanRequest->status === 'En attente')
                            <span class="badge bg-label-warning me-1">{{ ucfirst($loanRequest->status) }}</span>
                            @elseif ($loanRequest->status === 'Approuvé')
                            <span class="badge bg-label-success me-1">{{ ucfirst($loanRequest->status) }}</span>
                            @elseif ($loanRequest->status === 'Rejeté')
                            <span class="badge bg-label-info me-1">{{ ucfirst($loanRequest->status) }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $loanRequest->comments }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($loanRequest->created_at)->format('Y-m-d') }}
                        </td>
                   

                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded text-primary"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('loan_requests.show', $loanRequest->id) }}">
                                        <i class="bx bx-show me-1 text-success"></i> Show
                                    </a>
                                    <a class="dropdown-item" href="{{ route('loan_requests.edit', $loanRequest->id) }}">
                                        <i class="bx bx-edit-alt me-1 text-warning"></i> Edit
                                    </a>
                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $loanRequest->id }}">
                                        <i class="bx bx-trash me-1 text-danger"></i> Delete
                                    </a>
                                    @if($loanRequest->status === 'En attente')
                                    <!-- Approve Action -->
                                    <a class="dropdown-item" href="#" onclick="confirmApprove(event, '{{ $loanRequest->id }}')">
                                        <i class="bx bx-check-circle me-1 text-success"></i> Approve
                                    </a>
                               
                                    <!-- Reject Action -->
                                    <a class="dropdown-item" href="#" onclick="confirmApprove(event, '{{ $loanRequest->id }}')">
                                        <i class="bx bx-x-circle me-1 text-danger"></i> Reject
                                    </a>
                                    @endif
                                </div>
                            </div>
                        
                            <!-- Modal -->
                            <div class="modal fade" id="deleteModal{{ $loanRequest->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $loanRequest->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $loanRequest->id }}">Confirm Delete</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="alert alert-danger">
                                                <p>Are you sure you want to delete this loan request?</p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('loan_requests.destroy', $loanRequest->id) }}" method="POST">
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
                @else
                <p>Aucune demande trouvée.</p>
                @endif
</div>
        </div> </div> </div>
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
