@extends('layouts.app')

@section('content')


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Liste des postes') }}
                    </h2>
                    <a href="{{ route('postes.create') }}" class="btn btn-primary mb-3">Ajouter un poste</a>

                    @if ($message = Session::get('success'))
                    <script>
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: '{{ $message }}',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    </script>
                    @endif

                    @livewire('poste-search')
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
