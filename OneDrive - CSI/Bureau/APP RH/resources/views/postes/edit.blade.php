

    @extends('layouts.app')

    @section('content')
    <div id="main-layout" class="layout-container" style="width: 85%; position: relative; left: 16%;">
        <div class="container-xxl flex-grow-1 container-p-y">  
            <div class="bg-white shadow-md rounded-lg">  

                <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">
                        Modifier le poste
                  </h2>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form id="poste-form" action="{{ route('postes.update', $poste->id) }}" method="POST">
                        @method('PUT')
                        @csrf
<div class="mb-3">
    <label for="titre" class="form-label">Titre du poste</label>
    <input type="text" name="titre" id="titre" class="form-control" value="{{ old('titre', $poste->titre ?? '') }}" required>
</div>
<div class="mb-3">
    <label for="departement_id" class="form-label">Département</label>
    <select name="departement_id" id="departement_id" class="form-control" required>
        @foreach ($departements as $departement)
        <option value="{{ $departement->id }}" {{ (isset($poste) && $poste->departement_id == $departement->id) ? 'selected' : '' }}>{{ $departement->nom }}</option>
        @endforeach
    </select>
</div>
          <div class="mt-4 d-flex justify-content-end gap-2"> 
                 <button type="submit" id="submit-button" class="btn btn-primary">Modifier</button>
                 <a href="{{ route('postes.index') }}" class="btn btn-secondary float-end">Retour à la liste</a>
           

          </div> 
         </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('submit-button').addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the form from submitting immediately

            Swal.fire({
                title: 'Do you want to save the changes?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonColor: '#71dd37',
                cancelButtonColor: '#d33',
                denyButtonColor: '#3085d6',
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

@endsection