@extends('layouts.app')

@section('content')


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            Modifier le département
                        </h2>

                    <div class="py-12">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 bg-white border-b border-gray-200">
                                    <!-- Form for editing department -->
                                    <form id="edit-department-form" action="{{ route('departements.update', $departement->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <!-- Department Name Field -->
                                        <div class="mb-4">
                                            <label for="nom" class="block text-sm font-medium text-gray-700">Nom du département</label>
                                            <input type="text" id="nom" name="nom" value="{{ $departement->nom }}" class="form-control rounded-md shadow-sm mt-1 block w-full" required>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="mb-4">
                                            <button type="submit" id="save-button" class="btn btn-primary">Modifier</button>
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
                            document.getElementById('edit-department-form').addEventListener('submit', function (event) {
                                event.preventDefault(); // Prevent the form from submitting immediately

                                Swal.fire({
                                    title: "Voulez-vous enregistrer les modifications ?",
                                    showDenyButton: true,
                                    showCancelButton: true,
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
                    @endpush

@endsection
