
@extends('layouts.app')

@section('content')

    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Assigner des entités au département "{{ $departement->nom }}"
    </h2>

    <div class="container py-8">


        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form id="assign-form" action="{{ route('departements.assign.entite', $departement->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="entites" class="form-label">Sélectionner des entités</label>
                                <select name="entites[]" id="entites" class="form-control" multiple required>
                                    @foreach ($entites as $entite)
                                        <option value="{{ $entite->id }}">{{ $entite->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Assigner</button>
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
                    document.getElementById('assign-form').addEventListener('submit', function (event) {
                        event.preventDefault(); // Prevent the default form submission

                        Swal.fire({
                            title: "Do you want to continue?",
                            icon: "question",
                            iconHtml: "؟",
                            confirmButtonText: "Yes, continue!",
                            cancelButtonText: "No, cancel!",
                            showCancelButton: true,
                            showCloseButton: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                this.submit(); // Submit the form
                            } else if (result.dismiss === Swal.DismissReason.cancel) {
                                Swal.fire({
                                    title: "Cancelled",
                                    text: "Your action has been cancelled.",
                                    icon: "error"
                                });
                            }
                        });
                    });
                });
            </script>
    @endpush
