<div class="container my-4">
    <div class="row">
        <div class="col-md-12">
            <input type="text" wire:model.debounce.300ms="searchTerm" placeholder="Search authorizations..." class="form-control mb-3" />

            @if($authorizations->count())
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Employé</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Start Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">End Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duration Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duration</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($authorizations as $authorization)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($authorization->employee)
                                    {{ $authorization->employee->prenom }} {{ $authorization->employee->nom }}
                                    @else
                                    N/A <!-- Display N/A or handle as per your design if employee is null -->
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $authorization->type }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($authorization->start_date)->format('Y-m-d') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($authorization->end_date)->format('Y-m-d') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($authorization->duration_type) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $authorization->duration }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($authorization->status === 'pending')
                                        <span class="badge bg-label-warning me-1">{{ ucfirst($authorization->status) }}</span>
                                    @elseif ($authorization->status === 'approved')
                                        <span class="badge bg-label-success me-1">{{ ucfirst($authorization->status) }}</span>
                                    @elseif ($authorization->status === 'rejected')
                                        <span class="badge bg-label-danger">{{ ucfirst($authorization->status) }}</span>
                                    @endif
                                </td>

                                <!-- Approve Form -->
                                <form id="approve-form-{{ $authorization->id }}" action="{{ route('authorizations.approve', $authorization->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('PUT')
                                </form>

                                <!-- Reject Form -->
                                <form id="reject-form-{{ $authorization->id }}" action="{{ route('authorizations.reject', $authorization->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('PUT')
                                </form>

                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded text-primary"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('authorizations.show', $authorization->id) }}">
                                                <i class="bx bx-show me-1 text-success"></i> Show
                                            </a>
                                            @if($authorization->status === 'pending')
                                            <a class="dropdown-item" href="{{ route('authorizations.edit', $authorization->id) }}">
                                                <i class="bx bx-edit-alt me-1 text-warning"></i> Edit
                                            </a>
                                            @endif
                                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $authorization->id }}">
                                                <i class="bx bx-trash me-1 text-danger"></i> Delete
                                            </a>
                                            @if($authorization->status === 'pending')
                                                <a class="dropdown-item" href="#" onclick="confirmApprove(event, '{{ $authorization->id }}')">
                                                    <i class="bx bx-check-circle me-1 text-success"></i> Approve
                                                </a>
                                                <a class="dropdown-item" href="#" onclick="confirmReject(event, '{{ $authorization->id }}')">
                                                    <i class="bx bx-x-circle me-1 text-danger"></i> Reject
                                                </a>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Delete Confirmation Modal -->
                                    <div class="modal fade" id="deleteModal{{ $authorization->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $authorization->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $authorization->id }}">Confirmer la suppression</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="alert alert-danger alert-dismissible">
                                                    Êtes-vous sûr de vouloir supprimer cette autorisation ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                    <form action="{{ route('authorizations.destroy', $authorization->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Supprimer définitivement</button>
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
                  
                    <div class="mt-3">
                        {{ $authorizations->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            @else
                <p>No authorizations found.</p>
            @endif
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        console.log('SweetAlert2 script loaded');

        window.confirmApprove = function (event, id) {
            event.preventDefault();

            Swal.fire({
                title: 'Êtes-vous sûr?',
                text: "Vous allez approuver cette autorisation!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Oui, approuver!',
                cancelButtonText: 'Non, annuler!',
                reverseButtons: true,
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('approve-form-' + id).submit();
                }
            });
        };

        window.confirmReject = function (event, id) {
            event.preventDefault();

            Swal.fire({
                title: 'Êtes-vous sûr?',
                text: "Vous allez rejeter cette autorisation!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Oui, rejeter!',
                cancelButtonText: 'Non, annuler!',
                reverseButtons: true,
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('reject-form-' + id).submit();
                }
            });
        };

        $('form.d-inline').on('submit', function (event) {
            event.preventDefault();

            var form = this;

            Swal.fire({
                title: 'Êtes-vous sûr?',
                text: "Vous allez rejeter cette demande!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Oui, rejeter!',
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
                        'La demande n\'a pas été rejetée :)',
                        'error'
                    );
                }
            });
        });
    });
</script>
