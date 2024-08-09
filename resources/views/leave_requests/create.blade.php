<!-- resources/views/leave_requests/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Créer une Demande de Congé</h1>
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
                <input type="date" name="start_date" id="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date') }}">
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

            <button type="submit" class="btn btn-primary">Soumettre</button>
        </form>
    </div>

    <script>
        document.getElementById('leave_type_id').addEventListener('change', function() {
            var medicalCertificateDiv = document.getElementById('medical_certificate_div');
            var selectedType = this.options[this.selectedIndex].dataset.requiresMedicalCertificate;
            if (selectedType === '1') {
                medicalCertificateDiv.style.display = 'block';
            } else {
                medicalCertificateDiv.style.display = 'none';
            }
        });
    </script>
@endsection
