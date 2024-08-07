@extends('layouts.app')

@section('content')
    <div class="layout-container" style="width: 85%; position: relative; left: 16%;">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">
                {{ __('Liste des demandes administratives') }}
            </h2>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">


                    @if ($message = Session::get('success'))
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                Swal.fire({
                                    position: 'bottom-end',
                                    icon: "success",
                                    title: "{{ session('success') }}",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            });
                        </script>
                    @endif
                    @livewire('search-administrative-requests')
                    <!-- Create Button Aligned to the Right -->


                </div>
            </div>
        </div>
    </div>
@endsection
