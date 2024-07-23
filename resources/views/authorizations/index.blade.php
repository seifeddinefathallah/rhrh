@extends('layouts.app')

@section('content')



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Authorization Requests') }}
                    </h2>

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
                        <a href="{{ route('authorizations.create') }}" class="btn btn-success">Create Authorizations</a>
                    </div>
                    <div class="mb-4">
                        <a href="{{ route('authorizations.update-temporary-balances') }}" class="btn btn-success">Personaliser Authorizations</a>
                    </div>

                    @livewire('authorization-search')
                    <div class="mt-4">
                        {{ $authorizations->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
