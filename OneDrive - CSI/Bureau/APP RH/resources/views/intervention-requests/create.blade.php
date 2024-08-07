@extends('layouts.app')

@section('content')
<div id="main-layout" class="layout-container" style="width: 85%; position: relative; left: 16%;">
        
    <div class="container-xxl flex-grow-1 container-p-y">  
        <div class="bg-white shadow-md rounded-lg">
            <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">Créer une Demande d'Intervention</h2>

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
            <div class="mt-4 d-flex justify-content-end gap-2"> 
            <button type="submit" class="btn btn-primary float-end">Soumettre</button>
            <a href="{{ route('intervention-requests.index') }}" class="btn btn-secondary float-end">Retour</a>
            </div>
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
                confirmButtonColor: '#03c3ec',
                cancelButtonColor: '#d33',
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
