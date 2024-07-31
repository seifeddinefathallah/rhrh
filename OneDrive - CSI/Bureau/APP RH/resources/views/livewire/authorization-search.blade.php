<div class="container my-4">
    <div class="row">
        <div class="col-md-12">
    <input type="text" wire:model.debounce.300ms="searchTerm" placeholder="Search authorizations..." class="form-control mb-3" />

    @if($authorizations->count())
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-light">
                <tr>
                    <th >Employé</th>
                    <th >Type</th>
                    <th >Start Date</th>
                    <th >End Date</th>
                    <th >Duration Type</th>
                    <th >Duration</th>
                    <th >Status</th>
                    <th >Actions</th>
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
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('authorizations.show', $authorization->id) }}" class="btn btn-outline-primary btn-sm" title="View"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('authorizations.edit', $authorization->id) }}" class="btn btn-outline-success btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('authorizations.destroy', $authorization->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm delete-btn"  title="Delete"><i class="fas fa-trash-alt"></i></button>
                        </form>
                        <form action="{{ route('authorizations.approve', $authorization->id) }}" method="POST" class="approve-form">
                            @csrf
                            <button type="submit" class="btn btn-outline-success btn-sm approve-btn"  title="Approve"><i class="fas fa-check-circle"></i></button>
                        </form>
                        <form method="POST" action="{{ route('authorizations.reject', $authorization->id) }}" class="reject-form">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-outline-danger btn-sm reject-btn" title="Reject"><i class="fas fa-times-circle"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
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
