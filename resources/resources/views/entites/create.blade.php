@extends('layouts.app')

@section('content')
<div class="layout-container max-w-7xl mx-auto sm:px-6 lg:px-8" >
    <div class="container-xl flex-grow-1 container-p-y">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-3 bg-white border-b border-gray-200">
                <h1 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">Ajouter une nouvelle entité</h1>
                <form id="entity-form" action="{{ route('entites.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
              
                 
                   
                    @csrf
                    <div class="mb-3">
                        <label for="mb-2 font-semibold">Image de l'entité</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                    </div>
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" id="nom" name="nom" class="form-control {{ $errors->has('nom') ? 'input-invalid' : '' }}" required>
                        @if($errors->has('nom'))
                            <div class="error-message">
                                {{ $errors->first('nom') }}
                            </div>
                        @endif
                    </div>
                    
                    <div>
                        <label>Numéro Fiscal </label>
                        <input class="form-control"type="text" name="numero_fiscal" required>
                    </div>
                    <div>
                        <label>Adresse </label>
                        <input class="form-control" type="text" name="adresse" required>
                    </div>
                    <div>
                        <label>Pays </label>
                        <input class="form-control" type="text" name="pays" required>
                    </div>
                    <div>
                        <label>Contact </label>
                        <input class="form-control" type="text" name="contact" required>
                    </div>
                     
                    <div>
                        <label>Numéro SIRET </label>
                        <input class="form-control" type="text" name="numero_siret" required>
                    </div>
                    <div>
                        <label>Code APE/NAF </label>
                        <input class="form-control" type="text" name="code_ape_naf" required>
                    </div>
                    <div>
                        <label>Convention Collective </label>
                        <input class="form-control" type="text" name="convention_collective" required>
                    </div>
                    <div>
                        <label>Identifiant de l’établissement </label>
                        <input class="form-control" type="text" name="identifiant_etablissement" required>
                    </div>
             
                      <div class="mt-4 flex justify-content-end gap-2 float-end"> 

                        <button type="submit" class="btn btn-primary">Ajouter</button>
                        <a href="{{ route('entites.index') }}" class="btn btn-secondary ">
                            Retour à la liste
                        </a> 
                    </div>
               </div>
            </div>
                </form>
            </div>
        </div>
    </div>
@endsection

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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('entity-form').addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent the default form submission

            // Reset previous error states
            let form = this;
            let isValid = true;
            let firstInvalidField = null;
            let inputs = form.querySelectorAll('input[required]');
            let imageInput = form.querySelector('input[name="image"]');

            inputs.forEach(function(input) {
                input.classList.remove('input-invalid'); // Remove the red border class
                if (!input.value.trim()) {
                    isValid = false;
                    input.classList.add('input-invalid'); // Add the red border class
                    if (!firstInvalidField) {
                        firstInvalidField = input;
                    }
                }
            });

            // Validate the image input
            if (imageInput && imageInput.files.length === 0) {
                isValid = false;
                imageInput.classList.add('input-invalid'); // Add the red border class
                if (!firstInvalidField) {
                    firstInvalidField = imageInput;
                }
            } else {
                imageInput.classList.remove('input-invalid'); // Remove the red border class if valid
            }

            if (isValid) {
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
                        form.submit(); // Submit the form if the user confirms
                    }
                });
            } else {
                Swal.fire({
                    title: 'Erreur',
                    text: 'Veuillez remplir tous les champs requis, y compris l\'image.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then(() => {
                    if (firstInvalidField) {
                        firstInvalidField.focus(); 
                    }
                });
            }
        });
    });
</script>
