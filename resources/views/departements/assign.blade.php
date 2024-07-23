@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                    Assigner des entités au département "{{ $departement->nom }}"
                </h2>
                <form id="assign-form" action="{{ route('departements.assign.entite', $departement->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="entites" class="form-label">Sélectionner des entités</label>
                        @foreach ($entites as $entite)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="entite" id="entite{{ $entite->id }}" value="{{ $entite->id }}" required>
                            <label class="form-check-label" for="entite{{ $entite->id }}">
                                {{ $entite->nom }}
                            </label>
                        </div>
                        @endforeach
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

            swalWithBootstrapButtons.fire({
                title: "Are you sure?",
                text: "Do you want to continue?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, continue!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit(); // Submit the form
                    swalWithBootstrapButtons.fire({
                        title: "Success!",
                        text: "Your action has been processed.",
                        icon: "success"
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swalWithBootstrapButtons.fire({
                        title: "Cancelled",
                        text: "Your action has been cancelled.",
                        icon: "error"
                    });
                }
            });
        });
    });

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });
</script>
@endpush
