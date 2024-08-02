<div class="container my-4">
    <div class="row">
        <div class="col-md-12">
    <input type="text" wire:model.debounce.300ms="searchTerm" placeholder="Search authorizations..." class="form-control mb-3" />

    @if($authorizations->count())
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Type
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Start Date
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                End Date
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Duration Type
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Duration
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($authorizations as $authorization)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $authorization->type }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($authorization->start_date)->format('Y-m-d') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($authorization->end_date)->format('Y-m-d') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ ucfirst($authorization->duration_type) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $authorization->duration }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($authorization->status === 'pending')
                                <span class="badge bg-label-warning me-1">{{ ucfirst($authorization->status) }}</span>
                                @elseif ($authorization->status === 'approved')
                                <span class="badge bg-label-success me-1">{{ ucfirst($authorization->status) }}</span>
                                @elseif ($authorization->status === 'rejected')
                                <span class="badge bg-label-danger">{{ ucfirst($authorization->status) }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded text-primary"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                   
                                        <a class="dropdown-item" href="{{ route('authorizations.show', $authorization->id) }}">
                                            <i class="bx bx-show me-1 text-success"></i> Show
                                        </a>
                               
                                        <a class="dropdown-item" href="{{ route('authorizations.edit', $authorization->id) }}">
                                            <i class="bx bx-edit-alt me-1 text-warning"></i> Edit
                                        </a>
                               
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $authorization->id }}">
                                            <i class="bx bx-trash me-1 text-danger"></i> Delete
                                        </a>
                                       
                                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('approve-form-{{ $authorization->id }}').submit();">
                                            <i class="bx bx-check-circle me-1 text-success" ></i> Approve
                                        </a>
                            
                                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('reject-form-{{ $authorization->id }}').submit();">
                                            <i class="bx bx-x-circle me-1 text-danger"></i> Reject
                                        </a>
                                    
                                 
                                    </div>
                                </div>
                            
                                <!-- Modal de confirmation pour la suppression -->
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
                <div class="mb-3">
                    <a href="{{ route('authorizations.create') }}" class="btn btn-primary float-end">
                        {{ __('Créer une autorization') }}
                    </a>
                </div>
            <div class="mt-3">
            {{ $authorizations->links('pagination::bootstrap-4') }}
            </div>
    @else
    <p>No authorizations found.</p>
    @endif
</div>
            @push('scripts')
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    console.log('SweetAlert2 script loaded');

                    // Ensure jQuery is loaded
                    if (typeof jQuery === 'undefined') {
                        console.error('jQuery is not loaded');
                        return;
                    }

                    // Handle delete form confirmation
                    $('form.d-inline').on('submit', function (event) {
                        event.preventDefault(); // Prevent default form submission

                        var form = $(this); // Get the form that triggered the event

                        Swal.fire({
                            title: 'Êtes-vous sûr?',
                            text: "Vous ne pourrez pas revenir en arrière!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Oui, supprimez-le!',
                            cancelButtonText: 'Non, annuler!',
                            reverseButtons: true,
                            customClass: {
                                confirmButton: 'btn btn-success',
                                cancelButton: 'btn btn-danger'
                            },
                            buttonsStyling: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                console.log('Form submitted');
                                form.off('submit').submit(); // Remove the event handler and submit the form
                            } else {
                                Swal.fire(
                                    'Annulé',
                                    'Votre fichier est en sécurité :)',
                                    'error'
                                );
                            }
                        });
                    });
                });
            </script>
            @endpush
            @push('scripts')
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    console.log('SweetAlert2 script loaded');

                    document.querySelectorAll('form.approve-form').forEach(function (form) {
                        form.addEventListener('submit', function (event) {
                            event.preventDefault(); // Prevent the default form submission

                            Swal.fire({
                                title: 'Êtes-vous sûr?',
                                text: "Vous allez approuver cette demande!",
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
                                    console.log('Approval confirmed');
                                    form.submit(); // Submit the form if confirmed
                                } else {
                                    Swal.fire(
                                        'Annulé',
                                        'La demande n\'a pas été approuvée :)',
                                        'error'
                                    );
                                }
                            });
                        });
                    });
                });
            </script>
            @endpush
            @push('scripts')
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    console.log('SweetAlert2 script loaded');

                    document.querySelectorAll('form.reject-form').forEach(function (form) {
                        form.addEventListener('submit', function (event) {
                            event.preventDefault(); // Prevent the default form submission

                            Swal.fire({
                                title: 'Êtes-vous sûr?',
                                text: "Vous allez rejeter cette demande!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonText: 'Oui, rejeter!',
                                cancelButtonText: 'Non, annuler!',
                                reverseButtons: true,
                                customClass: {
                                    confirmButton: 'btn btn-danger',
                                    cancelButton: 'btn btn-secondary'
                                },
                                buttonsStyling: false
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    console.log('Rejection confirmed');
                                    form.submit(); // Submit the form if confirmed
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
                });
            </script>
            @endpush
