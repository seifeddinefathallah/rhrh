@extends('layouts.app')

@section('content')
<div class="layout-container max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="container-xxl flex-grow-1 container-p-y">  
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">Créer une Demande de Congé</h2>
            <form action="{{ route('leave_requests.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="leave_type_id">Type de Congé</label>
                    <select name="leave_type_id" id="leave_type_id" class="form-control @error('leave_type_id') is-invalid @enderror">
                        <option value="">Sélectionner un type de congé</option>
                        @foreach ($leaveTypes as $leaveType)
                            <option value="{{ $leaveType->id }}" data-requires-medical-certificate="{{ $leaveType->requires_medical_certificate }}">
                                {{ $leaveType->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('leave_type_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="start_date">Date de Début</label>
                    <input type="date" name="start_date" id="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ request()->query('start', old('start_date')) }}">

                    @error('start_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="end_date">Date de Fin</label>
                    <input type="date" name="end_date" id="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date') }}">
                    @error('end_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="reason">Motif</label>
                    <textarea name="reason" id="reason" class="form-control @error('reason') is-invalid @enderror">{{ old('reason') }}</textarea>
                    @error('reason')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div id="medical_certificate_div" class="form-group" style="display:none;">
                    <label for="medical_certificate">Certificat Médical (à télécharger dans les 48 heures)</label>
                    <input type="file" name="medical_certificate" id="medical_certificate" class="form-control @error('medical_certificate') is-invalid @enderror">
                    @error('medical_certificate')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-4 d-flex justify-content-end gap-2 float-end"> 
                    <button type="submit" class="btn btn-primary">Soumettre</button>
                    <a href="{{ route('leave_requests.index') }}" class="btn btn-secondary">Retour à la Liste</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        function getTodayDate() {
            var today = new Date();
            var day = ("0" + today.getDate()).slice(-2);
            var month = ("0" + (today.getMonth() + 1)).slice(-2);
            var year = today.getFullYear();
            return year + "-" + month + "-" + day;
        }

        function isWeekend(date) {
            var day = date.getDay();
            return (day === 0 || day === 6); // 0 is Sunday, 6 is Saturday
        }

        function setDateConstraints() {
            var today = getTodayDate();
            var startDateInput = document.getElementById('start_date');
            var endDateInput = document.getElementById('end_date');

            function updateMinDate() {
                var startDateValue = startDateInput.value;
                endDateInput.setAttribute('min', startDateValue);

                // If the current end date is before the start date, update it
                if (endDateInput.value && new Date(endDateInput.value) < new Date(startDateValue)) {
                    endDateInput.value = startDateValue;
                }
            }

            function validateDateInput(input) {
                var date = new Date(input.value);
                if (isWeekend(date)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Date invalide',
                        text: 'Les week-ends ne sont pas disponibles. Veuillez sélectionner un jour de semaine.',
                        confirmButtonColor: '#03428e',
                        timer: 5000
                    }).then(() => {
                        input.value = ''; // Clear the invalid value
                    });
                }
            }

            function setInitialConstraints() {
                var startDateValue = startDateInput.value;
                startDateInput.setAttribute('min', today);
                endDateInput.setAttribute('min',  startDateValue); 
            }

            startDateInput.addEventListener('input', function() {
                updateMinDate();
                validateDateInput(startDateInput);
            });

            endDateInput.addEventListener('input', function() {
                validateDateInput(endDateInput);
            });

            setInitialConstraints();
        }

        setDateConstraints();
    });
</script>
@endsection
