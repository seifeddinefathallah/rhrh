@extends('layouts.app')

@section('content')
<div id="main-layout" class="layout-container" style="width: 85%; position: relative; left: 16%;">
    <div class="container-xxl flex-grow-1 container-p-y">  
        <div class="bg-white shadow-md rounded-lg">
        <h1>Modifier la Demande d'Intervention</h1>

        <form id="intervention-form" action="{{ route('intervention-requests.update', $interventionRequest) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" required>{{ old('description', $interventionRequest->description) }}</textarea>
                @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="request_date">Date</label>
                <input type="date" name="request_date" id="request_date" class="form-control" value="{{ old('request_date', $interventionRequest->request_date instanceof \Carbon\Carbon ? $interventionRequest->request_date->format('Y-m-d') : '') }}" required>
                @error('request_date')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Sauvegarder</button>
            <a href="{{ route('intervention-requests.index') }}" class="btn btn-secondary">Retour</a>
        </form>
    </div>

    <!-- Include SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('intervention-form').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            Swal.fire({
                title: "🔄 Do you want to save the changes?",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "💾 Save",
                denyButtonText: `❌ Don't save`
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire("✅ Saved!", "", "success");
                    this.submit(); // Submit the form if confirmed
                } else if (result.isDenied) {
                    Swal.fire("⚠️ Changes are not saved", "", "info");
                }
            });
        });
    </script>
@endsection
