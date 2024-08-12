   @extends('layouts.app')

    @section('content')
      
    <div class="layout-container" style="layout-container max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" container-xxl flex-grow-1 container-p-y">  
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
               
        <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">
            {{ __('Liste des entités') }}
        </h2>
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
          
            <livewire:search-entities />
        </div>
       
    </div>
</div>
</div>
</div>

@endsection
