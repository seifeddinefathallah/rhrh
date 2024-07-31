 @extends('layouts.app')

    @section('content')
      
    <div class="layout-container" style="width: 85%; position: relative; left: 16%;">
            <div class=" container-xxl flex-grow-1 container-p-y"> 
                  <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                               Ajouter un nouveau poste
                  </h2>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('postes.store') }}" method="POST">
                        @include('postes.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
