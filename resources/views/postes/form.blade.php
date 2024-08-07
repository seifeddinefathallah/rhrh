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
<!--<button type="submit" id="submit-button" class="btn btn-primary">{ isset($poste) ? 'Mettre à jour' : 'Ajouter' }}</button>-->
<button type="submit" id="submit-button" class="btn btn-primary">    {{ isset($poste) ? 'Mettre à jour' : 'Ajouter' }}</button>
