@extends('layouts.app')

@section('content')
<div class="layout-container max-w-7xl mx-auto sm:px-6 lg:px-8" >
    <div class="container-xl flex-grow-1 container-p-y">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-3 bg-white border-b border-gray-200">
                <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">
                    Liste des départements
                </h2>
                <div class="p-6 bg-white border-b border-gray-200">
                    @livewire('departement-search')
                </div>
                
                @if(session('success'))
                    <div class="bg-green-200 border border-green-200 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">Success!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <!-- Error message -->
                @if(session('error'))
                    <div class="bg-red-200 border border-red-200 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">Error!</strong>
                        <span class="block sm:inline">{{ session('error') }}</span>
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
             
            </div>
   

        </div>
    </div>
</div>
@endsection

