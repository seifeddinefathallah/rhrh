@extends('layouts.app')

@section('content')
<div id="main-layout" class="layout-container" style="width: 85%; position: relative; left: 16%;">
    <div class="container-xxl flex-grow-1 container-p-y">  
        <div class="bg-white shadow-md rounded-lg">  
        
    <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">Modifier la Demande materiel</h2>
        <form id="editMaterialRequestForm" action="{{ route('material_requests.update', $materialRequest->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="material_name">Material Name</label>
                <input type="text" name="material_name" class="form-control" value="{{ $materialRequest->material_name }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control">{{ $materialRequest->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" class="form-control" value="{{ $materialRequest->quantity }}" required>
            </div>
            <div class="mt-4"> 
                <a href="{{ route('material_requests.index') }}" class="btn btn-secondary float-end">Retour à la liste</a>
                <button type="submit" class="btn btn-primary float-end"  id="submitButton">Sauvegarder</button>
                
            </div>
          
        </form>
    </div>
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.getElementById('submitButton').addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the form from submitting immediately

                Swal.fire({
                    title: 'Do you want to save the changes? 🤔',
                    text: 'You can save the changes or discard them.',
                    icon: 'warning',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Save ✨',
                    denyButtonText: `Don't save ❌`
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit the form if confirmed
                        document.getElementById('editMaterialRequestForm').submit();
                        Swal.fire('Saved! 🎉', '', 'success');
                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved ⚠️', '', 'info');
                    }
                });
            });
        </script>
    @endpush
@endsection
