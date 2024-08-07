@extends('layouts.app')

@section('content')
<div class="layout-container" style="width: 85%; position: relative; left: 16%;">
    <div class="container-xxl flex-grow-1 container-p-y">  
        
        <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">
            Modifier le département
        </h2>
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form id="edit-department-form" action="{{ route('departements.update', $departement->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom du département</label>
                            <input type="text" name="nom" id="nom" class="form-control" value="{{ $departement->nom }}" required>
                        </div>
                        <div class="mt-4 d-flex justify-content-end gap-2">
                            <button type="submit" id="save-button" class="btn btn-primary float-end">Modifier</button>   
                            <a href="{{ route('departements.index') }}" class="btn btn-secondary float-end">Retour à la liste</a>
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
        document.getElementById('edit-department-form').addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent the form from submitting immediately

            Swal.fire({
                title: "Voulez-vous enregistrer les modifications ?",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonColor: '#71dd37',
                cancelButtonColor: '#d33',
                denyButtonColor: '#3085d6',
                confirmButtonText: "Enregistrer",
                denyButtonText: `Ne pas enregistrer`,
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, submit the form
                    this.submit();
                    Swal.fire("Enregistré !", "", "success");
                } else if (result.isDenied) {
                    Swal.fire("Les modifications ne sont pas enregistrées", "", "info");
                }
            });
        });
    });
</script>
@endsection
