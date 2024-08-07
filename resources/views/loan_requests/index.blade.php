  @extends('layouts.app')

        @section('content')
             
        <div class="layout-container" style="width: 85%; position: relative; left: 16%;">
            <div class=" container-xxl flex-grow-1 container-p-y">  
          
                <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">
            {{ __('Les demandes') }}
        </h2>
               
                    
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
              
                @livewire('loan-request-search')
                
                <div class="mb-4">
                    <a href="{{ route('loan_requests.create') }}" class="btn btn-primary float-end">Create Loan</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
