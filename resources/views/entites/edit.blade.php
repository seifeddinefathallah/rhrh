@extends('layouts.app')

@section('content')
    <div class="layout-container max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="container-xl flex-grow-1 container-p-y">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-3 bg-white border-b border-gray-200">
                    <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">
                        Modifier l'entité
                    </h2>
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form id="edit-entite-form" action="{{ route('entites.update', $entite) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                                @if($entite->image)
                                    <img src="{{ Storage::url($entite->image) }}" alt="Image de l'entité" class="mt-2" style="max-width: 200px;">
                                @endif
                                @error('image')
                                <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="nom" class="form-label">Nom :</label>
                                <input type="text" name="nom" id="nom" value="{{ old('nom', $entite->nom) }}" class="form-control @error('nom') is-invalid @enderror">
                                @error('nom')
                                <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="numero_fiscal" class="form-label">Numéro Fiscal :</label>
                                <input type="text" name="numero_fiscal" id="numero_fiscal" value="{{ old('numero_fiscal', $entite->numero_fiscal) }}" class="form-control @error('numero_fiscal') is-invalid @enderror">
                                @error('numero_fiscal')
                                <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="adresse" class="form-label">Adresse :</label>
                                <input type="text" name="adresse" id="adresse" value="{{ old('adresse', $entite->adresse) }}" class="form-control @error('adresse') is-invalid @enderror">
                                @error('adresse')
                                <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="pays" class="form-label">Pays :</label>
                                <select name="pays" id="pays" class="form-control @error('pays') is-invalid @enderror">
                                    <option value="France" {{ old('pays', $entite->pays) === 'France' ? 'selected' : '' }}>France</option>
                                    <option value="Tunisie" {{ old('pays', $entite->pays) === 'Tunisie' ? 'selected' : '' }}>Tunisie</option>
                                    <option value="Autre" {{ old('pays', $entite->pays) === 'Autre' ? 'selected' : '' }}>Autre</option>
                                </select>
                                @error('pays')
                                <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4" id="other-country-field" style="{{ old('pays', $entite->pays) === 'Autre' ? '' : 'display: none;' }}">
                                <label for="autre_pays" class="form-label">Autre Pays :</label>
                                <input type="text" name="autre_pays" id="autre_pays" value="{{ old('autre_pays', $entite->autre_pays) }}" class="form-control @error('autre_pays') is-invalid @enderror">
                                @error('autre_pays')
                                <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="contact" class="form-label">Contact :</label>
                                <input type="text" name="contact" id="contact" value="{{ old('contact', $entite->contact) }}" class="form-control @error('contact') is-invalid @enderror">
                                @error('contact')
                                <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <div id="additional-fields" style="{{ old('pays', $entite->pays) === 'France' ? '' : 'display: none;' }}">
                                <div class="mb-4">
                                    <label for="numero_siret" class="form-label">Numéro SIRET :</label>
                                    <input type="text" name="numero_siret" id="numero_siret" value="{{ old('numero_siret', $entite->numero_siret) }}" class="form-control @error('numero_siret') is-invalid @enderror">
                                    @error('numero_siret')
                                    <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="code_ape_naf" class="form-label">Code APE/NAF :</label>
                                    <input type="text" name="code_ape_naf" id="code_ape_naf" value="{{ old('code_ape_naf', $entite->code_ape_naf) }}" class="form-control @error('code_ape_naf') is-invalid @enderror">
                                    @error('code_ape_naf')
                                    <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="convention_collective" class="form-label">Convention Collective :</label>
                                    <input type="text" name="convention_collective" id="convention_collective" value="{{ old('convention_collective', $entite->convention_collective) }}" class="form-control @error('convention_collective') is-invalid @enderror">
                                    @error('convention_collective')
                                    <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="identifiant_etablissement" class="form-label">Identifiant de l’établissement :</label>
                                <input type="text" name="identifiant_etablissement" id="identifiant_etablissement" value="{{ old('identifiant_etablissement', $entite->identifiant_etablissement) }}" class="form-control @error('identifiant_etablissement') is-invalid @enderror">
                                @error('identifiant_etablissement')
                                <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mt-4 d-flex justify-content-end gap-2">
                                <button type="submit" class="btn btn-primary">Modifier</button>
                                <a href="{{ route('entites.index') }}" class="btn btn-secondary">Retour à la liste</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('edit-entite-form');
            const paysInput = document.getElementById('pays');
            const additionalFields = document.getElementById('additional-fields');
            const otherCountryField = document.getElementById('other-country-field');

            // Handle the visibility of additional fields based on selected country
            paysInput.addEventListener('change', function () {
                const value = this.value;
                if (value === 'France') {
                    additionalFields.style.display = '';
                    otherCountryField.style.display = 'none';
                } else if (value === 'Autre') {
                    additionalFields.style.display = 'none';
                    otherCountryField.style.display = '';
                } else {
                    additionalFields.style.display = 'none';
                    otherCountryField.style.display = 'none';
                }
            });

            // Initial state check
            paysInput.dispatchEvent(new Event('change'));

            form.addEventListener('submit', function (event) {
                event.preventDefault(); // Prevent the form from submitting immediately

                Swal.fire({
                    title: "Do you want to save the changes?",
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonColor: '#71dd37',
                    cancelButtonColor: '#d33',
                    denyButtonColor: '#3085d6',
                    confirmButtonText: "Save",
                    denyButtonText: `Don't save`
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If confirmed, submit the form
                        form.submit();
                        Swal.fire("Saved!", "", "success");
                    } else if (result.isDenied) {
                        Swal.fire("Changes are not saved", "", "info");
                    }
                });
            });
        });
    </script>
@endsection
