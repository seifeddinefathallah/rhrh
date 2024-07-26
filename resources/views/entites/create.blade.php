@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Ajouter une nouvelle entité') }}
                </h2>
                <form id="entity-form" action="{{ route('entites.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                    @csrf
                    <div class="form-group">
                        <label for="image">Image de l'entité</label>
                        <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image">
                    </div>
                    <div>
                        <label for="nom" class="form-label">Nom :</label>
                        <input type="text" id="nom" name="nom" required class="form-control @error('nom') is-invalid @enderror">
                    </div>
                    <div>
                        <label for="numero_fiscal" class="form-label">Numéro Fiscal :</label>
                        <input type="text" id="numero_fiscal" name="numero_fiscal" required class="form-control @error('numero_fiscal') is-invalid @enderror">
                    </div>
                    <div>
                        <label for="adresse" class="form-label">Adresse :</label>
                        <input type="text" id="adresse" name="adresse" required class="form-control @error('adresse') is-invalid @enderror">
                    </div>
                    <div>
                        <label for="pays" class="form-label">Pays :</label>
                        <input type="text" id="pays" name="pays" required class="form-control @error('pays') is-invalid @enderror">
                    </div>
                    <div>
                        <label for="contact" class="form-label">Contact :</label>
                        <input type="text" id="contact" name="contact" required class="form-control @error('contact') is-invalid @enderror">
                    </div>
                    <div>
                        <label for="nom_employeur" class="form-label">Nom de l'employeur :</label>
                        <input type="text" id="nom_employeur" name="nom_employeur" required class="form-control @error('nom_employeur') is-invalid @enderror">
                    </div>
                    <div>
                        <label for="adresse_employeur" class="form-label">Adresse de l'employeur :</label>
                        <input type="text" id="adresse_employeur" name="adresse_employeur" required class="form-control @error('adresse_employeur') is-invalid @enderror">
                    </div>
                    <div>
                        <label for="numero_siret" class="form-label">Numéro SIRET :</label>
                        <input type="text" id="numero_siret" name="numero_siret" required class="form-control @error('numero_siret') is-invalid @enderror">
                    </div>
                    <div>
                        <label for="code_ape_naf" class="form-label">Code APE/NAF :</label>
                        <input type="text" id="code_ape_naf" name="code_ape_naf" required class="form-control @error('code_ape_naf') is-invalid @enderror">
                    </div>
                    <div>
                        <label for="convention_collective" class="form-label">Convention Collective :</label>
                        <input type="text" id="convention_collective" name="convention_collective" required class="form-control @error('convention_collective') is-invalid @enderror">
                    </div>
                    <div>
                        <label for="identifiant_etablissement" class="form-label">Identifiant de l’établissement :</label>
                        <input type="text" id="identifiant_etablissement" name="identifiant_etablissement" required class="form-control @error('identifiant_etablissement') is-invalid @enderror">
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('entity-form').addEventListener('submit', function (event) {
                event.preventDefault(); // Prevent the default form submission

                Swal.fire({
                    title: '⚠️ Vous êtes sûr ?',
                    icon: 'question',
                    iconHtml: '❓',
                    confirmButtonText: 'Oui, continuer !',
                    cancelButtonText: 'Non, annuler !',
                    showCancelButton: true,
                    showCloseButton: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit(); // Submit the form if the user confirms
                    }
                });
            });
        });
    </script>
@endpush
