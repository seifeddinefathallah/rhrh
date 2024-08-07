@extends('layouts.app')

@section('content')
<div id="main-layout" class="layout-container" style="width: 85%; position: relative; left: 16%;">
    <div class=" container-xxl mx-auto flex-grow-1 container-p-y">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <h1 class="text-2xl font-bold text-center my-6">Ajouter une nouvelle entité</h1>
                <form id="entity-form" action="{{ route('entites.store') }}" method="POST" enctype="multipart/form-data" class="p-6">



                    @csrf
                    <div class="form-group">
                        <label for="image">Image de l'entité</label>
                        <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image">
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
                    <div>
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
