@extends('layouts.app')

@section('content')
<div class="layout-container max-w-7xl mx-auto sm:px-6 lg:px-8" >
    <div class="container-xl flex-grow-1 container-p-y">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-3 bg-white border-b border-gray-200">

                <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">Create  demande spécifique</h2>
        <form id="specific-request-form" action="{{ route('specific_requests.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="request_type">Request Type</label>
                <input type="text" name="request_type" class="form-control @error('request_type') is-invalid @enderror" value="{{ old('request_type') }}" required>
                @error('request_type')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mt-4 d-flex justify-content-end gap-2"> 
            <button type="submit" class="btn btn-primary float-end">Créer</button>
            <a href="{{ route('specific_requests.index') }}" class="btn btn-secondary float-end">Retour à la liste</a>
            </div>
        </form>
    </div>
@endsection


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('specific-request-form').addEventListener('submit', function(event) {
            event.preventDefault();
            let form = this;

            Swal.fire({
                title: 'Are you sure? 🤔',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#03c3ec',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, submit it!  👍',
                cancelButtonText: 'No, cancel! ❌',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                } else {
                    Swal.fire(
                        'Cancelled',
                        'Your form is safe :)',
                        'error'
                    );
                }
            });
        });
    </script>

