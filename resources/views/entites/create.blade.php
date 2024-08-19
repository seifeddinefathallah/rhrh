@extends('layouts.app')

@section('content')
    <div class="layout-container max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="container-xl flex-grow-1 container-p-y">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-3 bg-white border-b border-gray-200">
                    <h1 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">Ajouter une nouvelle entité</h1>
                    <form id="entity-form" action="{{ route('entites.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                        @csrf
                        <div class="mb-3">
                            <label for="image" class="form-label">Image de l'entité</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                            @error('image')
                            <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" id="nom" name="nom" class="form-control @error('nom') is-invalid @enderror" required>
                            @error('nom')
                            <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="numero_fiscal" class="form-label">Numéro Fiscal</label>
                            <input type="text" id="numero_fiscal" name="numero_fiscal" class="form-control @error('numero_fiscal') is-invalid @enderror" required>
                            @error('numero_fiscal')
                            <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="adresse" class="form-label">Adresse</label>
                            <input type="text" id="adresse" name="adresse" class="form-control @error('adresse') is-invalid @enderror" required>
                            @error('adresse')
                            <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="pays" class="form-label">Pays</label>
                            <select id="pays" name="pays" class="form-control @error('pays') is-invalid @enderror" required>
                                <option value="" selected disabled>Sélectionnez un pays</option>
                                <option value="tunisie">Tunisie</option>
                                <option value="france">France</option>
                                <option value="autre">Autre Pays</option>
                            </select>
                            @error('pays')
                            <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Input field for "Autre Pays" -->
                        <div class="mb-3 d-none" id="autre-pays-container">
                            <label for="autre_pays" class="form-label">Entrez le nom du pays</label>
                            <input type="text" id="autre_pays" name="autre_pays" class="form-control @error('autre_pays') is-invalid @enderror">
                            @error('autre_pays')
                            <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="contact" class="form-label">Contact</label>
                            <input type="text" id="contact" name="contact" class="form-control @error('contact') is-invalid @enderror" required>
                            @error('contact')
                            <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Additional fields container -->
                        <div id="additional-fields-container" class="d-none">
                            <div class="mb-3">
                                <label for="numero_siret" class="form-label">Numéro SIRET/SIREN</label>
                                <input type="text" id="numero_siret" name="numero_siret" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="code_ape_naf" class="form-label">Code APE/NAF</label>
                                <input type="text" id="code_ape_naf" name="code_ape_naf" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="convention_collective" class="form-label">Convention collective applicable</label>
                                <input type="text" id="convention_collective" name="convention_collective" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="identifiant_etablissement" class="form-label">Identifiant de l’établissement</label>
                            <input type="text" id="identifiant_etablissement" name="identifiant_etablissement" class="form-control" required>
                            @error('identifiant_etablissement')
                            <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4 flex justify-content-end gap-2 float-end">
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                            <a href="{{ route('entites.index') }}" class="btn btn-secondary">Retour à la liste</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('entity-form');
            const additionalFieldsContainer = document.getElementById('additional-fields-container');
            const paysSelect = document.getElementById('pays');
            const autrePaysContainer = document.getElementById('autre-pays-container');

            form.addEventListener('submit', function (event) {
                event.preventDefault(); // Prevent default form submission

                Swal.fire({
                    title: '⚠️ Vous êtes sûr ?',
                    icon: 'question',
                    confirmButtonText: 'Oui, continuer !',
                    cancelButtonText: 'Non, annuler !',
                    showCancelButton: true,
                    showCloseButton: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Submit form if confirmed
                    }
                });
            });

            // Show additional fields if 'pays' is 'France'
            paysSelect.addEventListener('change', function () {
                const value = this.value.trim().toLowerCase();
                if (value === 'autre') {
                    autrePaysContainer.classList.remove('d-none');
                    additionalFieldsContainer.classList.add('d-none'); // Hide France-specific fields
                } else if (value === 'france') {
                    autrePaysContainer.classList.add('d-none');
                    additionalFieldsContainer.classList.remove('d-none'); // Show France-specific fields
                } else {
                    autrePaysContainer.classList.add('d-none');
                    additionalFieldsContainer.classList.add('d-none'); // Hide additional fields
                }
            });
        });
    </script>
@endpush
