@extends('layouts.app')

@section('content')
<div class="layout-container max-w-7xl mx-auto sm:px-6 lg:px-8" >
    <div class="container-xl flex-grow-1 container-p-y">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-3 bg-white border-b border-gray-200">
                <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">
                    {{ __('Liste des demandes administratives') }}
                </h2>

            

                <!-- SweetAlert2 Notification -->
            
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
        

                <!-- Actions and Search --> 
                <div class="mb-4 flex justify-between items-center">
                 
                    <livewire:search-administrative-requests />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

