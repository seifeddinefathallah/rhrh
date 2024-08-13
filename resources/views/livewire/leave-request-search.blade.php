<div>
    <input type="text" wire:model="search" placeholder="Search by employee name or leave type..." class="form-control mb-4" />

    @if($leaveRequests->isEmpty())
        <p>No leave requests found.</p>
    @else
        <table class="table">
            <thead>
            <tr>
                <th>Employé</th>
                <th>Type de Congé</th>
                <th>Date de Début</th>
                <th>Date de Fin</th>
                <th>Motif</th>
                <th>Certificat Médical</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($leaveRequests as $request)
                <tr>
                    <td>{{ $request->employee->prenom ?? 'Inconnu' }} {{ $request->employee->nom ?? 'Inconnu' }}</td> <!-- Assuming you have an employee relationship -->
                    <td>{{ $request->leaveType->name }}</td>
                    <td>{{ $request->start_date->format('d/m/Y') }}</td>
                    <td>{{ $request->end_date->format('d/m/Y') }}</td>
                    <td>{{ $request->reason }}</td>
                    <td>
                        @if ($request->medical_certificate)
                            <a href="{{ Storage::url($request->medical_certificate) }}" target="_blank" class="btn btn-info btn-sm">Voir Certificat</a>
                        @elseif ($request->certificate_upload_deadline)
                            <div class="countdown" data-deadline="{{ $request->certificate_upload_deadline->toIso8601String() }}"></div>
                        @else
                            Pas de certificat
                        @endif
                    </td>

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
                    <td>
                        <a href="{{ route('leave_requests.edit', $request) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('leave_requests.destroy', $request) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette demande ?')">Supprimer</button>
                        </form>
                        @if($request->status === 'pending')
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('approve-form-{{ $request->id }}').submit();">
                                <i class="bx bx-check-circle me-1 text-success" ></i> Approve
                            </a>

                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('reject-form-{{ $request->id }}').submit();">
                                <i class="bx bx-x-circle me-1 text-danger"></i> Reject
                            </a>
                        @endif
                        <form id="approve-form-{{ $request->id }}" action="{{ route('leave_requests.approve', $request->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('PUT')
                        </form>

                        <!-- Reject Form -->
                        <form id="reject-form-{{ $request->id }}" action="{{ route('leave_requests.reject', $request->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('PUT')
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.countdown').forEach(function(element) {
            var deadline = new Date(element.getAttribute('data-deadline'));

            var countdown = function() {
                var now = new Date();
                var timeRemaining = deadline - now;

                if (timeRemaining <= 0) {
                    element.innerHTML = 'Le délai est écoulé.';
                    return;
                }

                var hours = Math.floor((timeRemaining / (1000 * 60 * 60)) % 24);
                var minutes = Math.floor((timeRemaining / (1000 * 60)) % 60);
                var seconds = Math.floor((timeRemaining / 1000) % 60);

                element.innerHTML =
                    'Temps restant : ' +
                    hours + ' heures ' +
                    minutes + ' minutes ' +
                    seconds + ' secondes';
            };

            setInterval(countdown, 1000);
            countdown();
        });
    });
</script>
