@extends('layouts.app')

@section('content')

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Liste des entités') }}
                </h2>
                @if(session('success'))
                <div class="alert alert-success mb-4">
                    <strong class="font-bold">Success!</strong>
                    <span>{{ session('success') }}</span>
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-error mb-4">
                    <strong class="font-bold">Error!</strong>
                    <span>{{ session('error') }}</span>
                </div>
                @endif

                <!-- SweetAlert2 Notification -->
                @push('scripts')
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                    @if(session('success'))
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: "{{ session('success') }}",
                                showConfirmButton: false,
                                timer: 1500
                            });
                    @elseif(session('error'))
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: "{{ session('error') }}",
                            footer: '<a href="#">Why do I have this issue?</a>'
                        });
                    @endif
                    });
                </script>
                @endpush

                <!-- Actions and Search -->
                <div class="mb-4 flex justify-between items-center">
                    <a href="{{ route('entites.create') }}" class="btn btn-primary">Créer Entite</a>
                    <livewire:search-entities />
                </div>


            </div>
        </div>
    </div>
</div>

@endsection
