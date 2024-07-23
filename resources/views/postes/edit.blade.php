@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form id="poste-form" action="{{ route('postes.update', $poste->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Form Fields -->
                    <div class="mb-3">
                        <label for="titre" class="form-label">Titre</label>
                        <input type="text" name="titre" id="titre" class="form-control" value="{{ $poste->titre }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="departement_id" class="form-label">Département</label>
                        <select name="departement_id" id="departement_id" class="form-control" required>
                            @foreach($departements as $departement)
                            <option value="{{ $departement->id }}" {{ $poste->departement_id == $departement->id ? 'selected' : '' }}>
                                {{ $departement->nom }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="button" id="submit-button" class="btn btn-primary">
                        Mettre à jour
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('submit-button').addEventListener('click', function () {
            Swal.fire({
                title: 'Do you want to save the changes?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Save',
                denyButtonText: `Don't save`,
                customClass: {
                    confirmButton: 'btn btn-success',
                    denyButton: 'btn btn-danger',
                    cancelButton: 'btn btn-secondary'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, submit the form
                    document.getElementById('poste-form').submit();
                    Swal.fire('Saved!', '', 'success');
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info');
                }
            });
        });
    });
</script>
@endpush
@endsection
