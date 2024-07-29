@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Supply Request</h1>
        <form id="editSupplyRequestForm" action="{{ route('supply_requests.update', $supplyRequest->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="item_name">Item Name</label>
                <input type="text" class="form-control" id="item_name" name="item_name" value="{{ $supplyRequest->item_name }}" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $supplyRequest->quantity }}" required>
            </div>
            <button type="submit" class="btn btn-primary" id="submitButton">Update</button>
        </form>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.getElementById('submitButton').addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the form from submitting immediately

                Swal.fire({
                    title: 'Do you want to save the changes?',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Save',
                    denyButtonText: `Don't save`
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit the form if confirmed
                        document.getElementById('editSupplyRequestForm').submit();
                        Swal.fire('Saved!', '', 'success');
                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info');
                    }
                });
            });
        </script>
    @endpush
@endsection
