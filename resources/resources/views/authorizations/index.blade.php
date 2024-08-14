@extends('layouts.app')

@section('content')
<div class="layout-container max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="container-xxl flex-grow-1 container-p-y">  
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-3 bg-white border-b border-gray-200">
        <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">
            {{ __('Authorization Requests') }}
        </h2>
        <div class="mb-3">
            <a href="{{ route('authorizations.create') }}" class="btn btn-primary float-end">
                {{ __('Créer une autorization') }}
            </a>
        </div>
        @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 1500
                });
            });
        </script>
        @endif

        @if(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '{{ session('error') }}',
                    footer: '<a href="#">Why do I have this issue?</a>'
                });
            });
        </script>
        @endif
       
        <div class="mb-4">
            <a href="{{ route('authorizations.update-temporary-balances') }}" class="btn btn-secondary">Personaliser Authorizations</a>
        </div>

        @livewire('authorization-search')
        
    </div>
</div>
</div>
</div>
@endsection
