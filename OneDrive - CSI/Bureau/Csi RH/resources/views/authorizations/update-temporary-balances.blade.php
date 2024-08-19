@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">Update Temporary Balances</h2>

        <form id="update-form" method="POST" action="{{ route('temporary-balances.update') }}">
            @csrf
            <div class="mb-4">
                <label for="period" class="form-label">Période :</label>
                <select id="period" name="period" class="form-control" required>
                    <option value="day">Jour</option>
                    <option value="month">Mois</option>
                    <option value="year">Année</option>
                    <!-- Ajouter d'autres périodes personnalisées si nécessaire -->
                </select>
            </div>

            <div class="mb-4">
                <label for="start_date" class="form-label">Date de début :</label>
                <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}" class="form-control" required>
            </div>

            <div class="mb-4">
                <label for="end_date" class="form-label">Date de fin :</label>
                <input type="date" id="end_date" name="end_date" value="{{ old('end_date') }}" class="form-control" required>
            </div>

            <div class="mb-4">
                <label for="sortie_hours" class="form-label">Heures de sortie :</label>
                <input type="number" id="sortie_hours" name="sortie_hours" step="0.1" value="{{ old('sortie_hours') }}" class="form-control" required>
            </div>

            <div class="mb-4">
                <label for="teletravail_days" class="form-label">Jours de télétravail :</label>
                <input type="number" id="teletravail_days" name="teletravail_days" step="0.1" value="{{ old('teletravail_days') }}" class="form-control" required>
            </div>

            <button type="submit" id="save-button" class="btn btn-primary">Enregistrer</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const periodSelect = document.getElementById('period');
            const startDateInput = document.getElementById('start_date');
            const endDateInput = document.getElementById('end_date');
            const sortieHoursInput = document.getElementById('sortie_hours');
            let teletravailDaysInput = document.getElementById('teletravail_days');

            function updateFields() {
                const period = periodSelect.value;

                if (period === 'day') {
                    // Set end_date to start_date
                    endDateInput.value = startDateInput.value;

                    // Limit sortie_hours to 2 hours
                    sortieHoursInput.max = 2;

                    // Change teletravail_days to a dropdown
                    const teletravailDaysDropdown = document.createElement('select');
                    teletravailDaysDropdown.id = 'teletravail_days';
                    teletravailDaysDropdown.name = 'teletravail_days';
                    teletravailDaysDropdown.className = 'form-control';
                    teletravailDaysDropdown.required = true;
                    teletravailDaysDropdown.innerHTML = `
                        <option value="1">Full Day</option>
                        <option value="0.5">Half Day</option>
                    `;

                    teletravailDaysInput.parentNode.replaceChild(teletravailDaysDropdown, teletravailDaysInput);
                    teletravailDaysInput = teletravailDaysDropdown;
                } else {
                    // Remove restrictions if period is not 'day'
                    sortieHoursInput.removeAttribute('max');

                    // Change teletravail_days back to number input
                    const teletravailDaysNumber = document.createElement('input');
                    teletravailDaysNumber.type = 'number';
                    teletravailDaysNumber.id = 'teletravail_days';
                    teletravailDaysNumber.name = 'teletravail_days';
                    teletravailDaysNumber.step = '0.1';
                    teletravailDaysNumber.value = '{{ old('teletravail_days') }}';
                    teletravailDaysNumber.className = 'form-control';
                    teletravailDaysNumber.required = true;

                    teletravailDaysInput.parentNode.replaceChild(teletravailDaysNumber, teletravailDaysInput);
                    teletravailDaysInput = teletravailDaysNumber;
                }
            }

            periodSelect.addEventListener('change', updateFields);
            startDateInput.addEventListener('change', function () {
                if (periodSelect.value === 'day') {
                    endDateInput.value = startDateInput.value;
                }
            });

            // Ensure fields are correctly set on initial load
            updateFields();
        });
    </script>
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('update-form').addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent the form from submitting immediately

            Swal.fire({
                title: "Voulez-vous enregistrer les modifications ?",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Enregistrer",
                denyButtonText: `Ne pas enregistrer`,
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, submit the form
                    this.submit();
                    Swal.fire("Enregistré !", "", "success");
                } else if (result.isDenied) {
                    Swal.fire("Les modifications ne sont pas enregistrées", "", "info");
                }
            });
        });
    });
</script>
@endpush
@endsection
