@extends('layouts.app')

@section('content')
<div id="main-layout" class="layout-container" style="width: 85%; position: relative; left: 16%;">
    <div class="container-xxl flex-grow-1 container-p-y">  
        <div class="bg-white shadow-md rounded-lg"> 
                <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">
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

