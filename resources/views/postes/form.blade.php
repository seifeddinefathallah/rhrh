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
<button type="submit" id="submit-button" class="btn btn-primary">{{ isset($poste) ? 'Mettre à jour' : 'Ajouter' }}</button>
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
                    Swal.fire('Poste are not saved', '', 'info');
                }
            });
        });
    });
</script>
