@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Specific Request</h1>
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
            <button type="submit" class="btn btn-primary">Submit</button>
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

