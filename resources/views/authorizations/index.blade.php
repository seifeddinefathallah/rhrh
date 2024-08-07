@extends('layouts.app')

@section('content')
<div class="layout-container" style="width: 85%; position: relative; left: 16%;">
    <div class="container-xxl flex-grow-1 container-p-y">  

        <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">
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
            <a href="{{ route('authorizations.update-temporary-balances') }}" class="btn btn-secondary">Personaliser Authorizations</a>
        </div>

        @livewire('authorization-search')
        
    </div>
</div>
</div>
</div>
@endsection
