@extends('layouts.app')

@section('content')
<div id="main-layout" class="layout-container" style="width: 85%; position: relative; left: 16%;">
    <div class="container-xxl flex-grow-1 container-p-y">  
        <div class="bg-white shadow-md rounded-lg">  
    <h1>Edit Specific Request</h1>
        <form id="specific-request-form" action="{{ route('specific_requests.update', $specificRequest->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="request_type">Request Type</label>
                <input type="text" name="request_type" class="form-control @error('request_type') is-invalid @enderror" value="{{ $specificRequest->request_type }}" required>
                @error('request_type')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ $specificRequest->description }}</textarea>
                @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.all.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('specific-request-form').addEventListener('submit', function(event) {
                event.preventDefault();
                let form = this;

                Swal.fire({
                    title: 'Are you sure? 🤔',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, update it! 👍',
                    cancelButtonText: 'No, cancel! ❌',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Request updated successfully! ✅",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    } else {
                        Swal.fire(
                            'Cancelled 😌',
                            'Your form is safe :)',
                            'error'
                        );
                    }
                });
            });
        });
    </script>

