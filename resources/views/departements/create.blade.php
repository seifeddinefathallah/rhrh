

    @extends('layouts.app')

    @section('content') 
    <div class="layout-container" style="width: 85%; position: relative; left: 16%;">
   
      <div class=" container-xxl flex-grow-1 container-p-y">  
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200"> 
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        Ajouter un département
                         </h2>
                    <form action="{{ route('departements.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom du département</label>
                            <input type="text" name="nom" id="nom" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection