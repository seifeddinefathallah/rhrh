@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form id="edit-entite-form" action="{{ route('entites.update', $entite) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-4">
                        <label for="image" class="block text-sm font-medium text-gray-700">Image de l'entité</label>
                        <input type="file" class="form-control-file mt-1 block w-full border-gray-300 rounded-md shadow-sm" id="image" name="image">
                    </div>

                    <div class="mb-4">
                        <label for="nom" class="block text-sm font-medium text-gray-700">Nom :</label>
                        <input type="text" name="nom" id="nom" value="{{ old('nom', $entite->nom) }}" class="form-control">
                    </div>

                    <div class="mb-4">
                        <label for="numero_fiscal" class="block text-sm font-medium text-gray-700">Numéro Fiscal :</label>
                        <input type="text" name="numero_fiscal" id="numero_fiscal" value="{{ old('numero_fiscal', $entite->numero_fiscal) }}" class="form-control">
                    </div>

                    <div class="mb-4">
                        <label for="adresse" class="block text-sm font-medium text-gray-700">Adresse :</label>
                        <input type="text" name="adresse" id="adresse" value="{{ old('adresse', $entite->adresse) }}" class="form-control">
                    </div>

                    <div class="mb-4">
                        <label for="pays" class="block text-sm font-medium text-gray-700">Pays :</label>
                        <input type="text" name="pays" id="pays" value="{{ old('pays', $entite->pays) }}" class="form-control">
                    </div>

                    <div class="mb-4">
                        <label for="contact" class="block text-sm font-medium text-gray-700">Contact :</label>
                        <input type="text" name="contact" id="contact" value="{{ old('contact', $entite->contact) }}" class="form-control">
                    </div>

                    <div class="mb-4">
                        <label for="nom_employeur" class="block text-sm font-medium text-gray-700">Nom de l'employeur :</label>
                        <input type="text" name="nom_employeur" id="nom_employeur" value="{{ old('nom_employeur', $entite->nom_employeur) }}" class="form-control">
                    </div>

                    <div class="mb-4">
                        <label for="adresse_employeur" class="block text-sm font-medium text-gray-700">Adresse de l'employeur :</label>
                        <input type="text" name="adresse_employeur" id="adresse_employeur" value="{{ old('adresse_employeur', $entite->adresse_employeur) }}" class="form-control">
                    </div>

                    <div class="mb-4">
                        <label for="numero_siret" class="block text-sm font-medium text-gray-700">Numéro SIRET :</label>
                        <input type="text" name="numero_siret" id="numero_siret" value="{{ old('numero_siret', $entite->numero_siret) }}" class="form-control">
                    </div>

                    <div class="mb-4">
                        <label for="code_ape_naf" class="block text-sm font-medium text-gray-700">Code APE/NAF :</label>
                        <input type="text" name="code_ape_naf" id="code_ape_naf" value="{{ old('code_ape_naf', $entite->code_ape_naf) }}" class="form-control">
                    </div>

                    <div class="mb-4">
                        <label for="convention_collective" class="block text-sm font-medium text-gray-700">Convention Collective :</label>
                        <input type="text" name="convention_collective" id="convention_collective" value="{{ old('convention_collective', $entite->convention_collective) }}" class="form-control">
                    </div>

                    <div class="mb-4">
                        <label for="identifiant_etablissement" class="block text-sm font-medium text-gray-700">Identifiant de l’établissement :</label>
                        <input type="text" name="identifiant_etablissement" id="identifiant_etablissement" value="{{ old('identifiant_etablissement', $entite->identifiant_etablissement) }}" class="form-control">
                    </div>

                    <div class="mb-4">
                        <button type="submit" id="save-button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Modifier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('edit-entite-form').addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent the form from submitting immediately

            Swal.fire({
                title: "Do you want to save the changes?",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Save",
                denyButtonText: `Don't save`
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, submit the form
                    this.submit();
                    Swal.fire("Saved!", "", "success");
                } else if (result.isDenied) {
                    Swal.fire("Changes are not saved", "", "info");
                }
            });
        });
    });
</script>
@endpush
@endsection
