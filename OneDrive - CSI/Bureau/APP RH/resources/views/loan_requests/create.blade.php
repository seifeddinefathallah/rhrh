<!-- resources/views/loan_requests/create.blade.php -->
   @extends('layouts.app')

    @section('content')
     
    <div class="layout-container" style="width: 85%; position: relative; left: 16%;">
            <div class=" container-xxl flex-grow-1 container-p-y">  
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">
            {{ __('Nouvelle demande') }}
        </h2>
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('loan_requests.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="type">Type de demande</label>
                            <select name="type" id="type" class="form-control" required>
                                <option value="Prêt">Prêt</option>
                                <option value="Avances">Avances</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="amount">Montant</label>
                            <input type="number" name="amount" id="amount" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="comments">Commentaires</label>
                            <textarea name="comments" id="comments" class="form-control"></textarea>
                        </div>
                        <div class="mt-4 d-flex justify-content-end gap-2"> 
                        <button type="submit" class="btn btn-primary">Créer</button>
                        <a href="{{ route('loan_requests.index') }}" class="btn btn-secondary float-end">Retour à la liste</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
