@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg border border-gray-200">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-6">
                    {{ __('Liste des demandes administratives') }}
                </h2>

                <!-- Success and Error Messages -->
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
                    <a href="{{ route('requests.create') }}" class="btn btn-primary">Créer Demande</a>
                    <livewire:search-administrative-requests />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .alert {
        padding: 1rem;
        border-radius: 0.375rem;
        margin-bottom: 1rem;
        border-width: 1px;
    }
    .alert-success {
        background-color: #d1fae5;
        border-color: #bbf7d0;
        color: #065f46;
    }
    .alert-error {
        background-color: #fee2e2;
        border-color: #fda4af;
        color: #b91c1c;
    }
    .btn {
        display: inline-block;
        font-weight: 600;
        text-align: center;
        border-radius: 0.375rem;
        padding: 0.5rem 1rem;
        text-decoration: none;
        cursor: pointer;
    }
    .btn-primary {
        background-color: #4f46e5;
        color: white;
        border: 1px solid transparent;
        transition: background-color 0.2s;
    }
    .btn-primary:hover {
        background-color: #3730a3;
    }
</style>
@endpush
