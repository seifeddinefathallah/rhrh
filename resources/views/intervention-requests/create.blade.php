@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Créer une Demande d'Intervention</h1>

        <form id="intervention-form" action="{{ route('intervention-requests.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" required>{{ old('description') }}</textarea>
                @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="request_date">Date</label>
                <input type="date" name="request_date" id="request_date" class="form-control" value="{{ old('request_date') }}" required>
                @error('request_date')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Hidden field for status -->
            <input type="hidden" name="status" value="pending">

            <button type="submit" class="btn btn-primary">Soumettre</button>
            <a href="{{ route('intervention-requests.index') }}" class="btn btn-secondary">Retour</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- SweetAlert2 Script -->
    <script>
        document.getElementById('intervention-form').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting immediately

            Swal.fire({
                title: "Do you want to continue ?",
                icon: "question",
                iconHtml: "؟",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                showCancelButton: true,
                showCloseButton: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, submit the form
                    this.submit();
                }
            });
        });
    </script>
@endsection
