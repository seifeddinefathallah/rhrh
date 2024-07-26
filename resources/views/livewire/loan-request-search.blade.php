<div>
    <div class="row">
        <div class="col-md-12">
    <input type="text" wire:model.debounce.300ms="search" placeholder="Rechercher par nom d'employé..." class="form-control form-control-navbar" aria-label="Search" />
            <div class="table-responsive">

                <table class="table table-striped table-bordered">
                    <thead class="table-light">
        <tr>
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
        <tbody>
        @forelse ($loanRequests as $loanRequest)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    @if ($loanRequest->employee)
                        {{ $loanRequest->employee->prenom }} {{ $loanRequest->employee->nom }}
                    @else
                        N/A <!-- Display N/A or handle as per your design if employee is null -->
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
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
                        <span class="badge badge-warning">{{ ucfirst($loanRequest->status) }}</span>
                    @elseif ($loanRequest->status === 'Approuvé')
                        <span class="badge badge-success">{{ ucfirst($loanRequest->status) }}</span>
                    @elseif ($loanRequest->status === 'Rejeté')
                        <span class="badge badge-danger">{{ ucfirst($loanRequest->status) }}</span>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    {{ $loanRequest->comments }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    {{ \Carbon\Carbon::parse($loanRequest->created_at)->format('Y-m-d') }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">

                    <a href="{{ route('loan_requests.show', $loanRequest->id) }}" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('loan_requests.edit', $loanRequest->id) }}" class="btn btn-outline-success btn-sm">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('loan_requests.destroy', $loanRequest->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm delete-btn">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </td>

            </tr>
        @empty
            <tr>
                <td colspan="5">Aucun résultat trouvé.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
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
