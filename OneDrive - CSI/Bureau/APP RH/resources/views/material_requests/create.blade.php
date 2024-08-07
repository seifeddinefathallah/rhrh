@extends('layouts.app')

@section('content')
<div id="main-layout" class="layout-container" style="width: 85%; position: relative; left: 16%;">
    <div class="container-xxl flex-grow-1 container-p-y">  
        <div class="bg-white shadow-md rounded-lg">  
    <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">Demande de matérieles informatiques</h2>
        <form id="material-request-form" action="{{ route('material_requests.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="material_name">Material Name</label>
                <input type="text" name="material_name" class="form-control @error('material_name') is-invalid @enderror" value="{{ old('material_name') }}" required>
                @error('material_name')
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
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity') }}" required>
                @error('quantity')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            
            <a href="{{ route('material_requests.index') }}" class="btn btn-secondary float-end">Retour à la liste</a>
    <button type="submit" class="btn btn-primary float-end ">Créer</button>   
 </form>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('material-request-form').addEventListener('submit', function(event) {
            event.preventDefault();
            let form = this;

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, submit it!',
                cancelButtonText: 'No, cancel!',
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
@endsection
