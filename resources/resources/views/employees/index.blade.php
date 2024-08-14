<!-- resources/views/employees/index.blade.php -->

@extends('layouts.app')

@section('content')
    <!-- Conteneur principal avec classes dynamiques -->
    <div class="layout-container max-w-7xl mx-auto sm:px-6 lg:px-8" >
        <div class="container-xl flex-grow-1 container-p-y">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-3 bg-white border-b border-gray-200">
                    <!-- Success Message -->
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

                    <!-- Import Employees Form -->
                    <div class="mb-3" style="width: 50%;">
                        <form action="{{ route('employees.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf  
                            <label class="mb-3" for="file">{{ __('Choose Excel File') }}</label>
                            <div class="input-group">
                                <input type="file" class="form-control" id="file" name="file">
                                <button type="submit" class="btn btn-secondary">{{ __('Import Employees') }}</button>
                            </div>
                        </form>
                    </div>
                    <div class="mb-3">
                        <a href="{{ route('employees.create') }}" class="btn btn-primary float-end">Create Employee</a>
                    </div>

        </div>
                    <!-- Livewire Component and Pagination -->
                    <div>
                        <!-- Include Livewire Component Here -->
                        @livewire('employee-search')

                        <!-- Create Employee Button -->
           </div>                
                    </div>
                </div>
         
    </div>
@endsection
