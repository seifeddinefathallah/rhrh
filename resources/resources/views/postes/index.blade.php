@extends('layouts.app')

@section('content')
<div id="main-layout" class="layout-container" style="width: 85%; position: relative; left: 16%;">
    <div class="container-xxl flex-grow-1 container-p-y">  
        <div class="bg-white shadow-md rounded-lg">  

        <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">
            Liste des postes
        </h2>
 
        @livewire('poste-search')

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <!-- Success message -->
                @if ($message = Session::get('success'))
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            Swal.fire({
                                position: 'bottom-end',
                                icon: 'success',
                                title: "{{ $message }}",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        });
                    </script>
                @endif

                <!-- Error message -->
                @if ($message = Session::get('error'))
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: "{{ $message }}",
                                footer: '<a href="#">Why do I have this issue?</a>'
                            });
                        });
                    </script>
                @endif

                <!-- Button to add a new post -->
               
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
