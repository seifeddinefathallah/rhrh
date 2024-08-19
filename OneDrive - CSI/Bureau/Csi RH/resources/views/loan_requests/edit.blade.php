   @extends('layouts.app')

    @section('content')

       
    <div class="layout-container max-w-7xl mx-auto sm:px-6 lg:px-8" >
        <div class="container-xl flex-grow-1 container-p-y">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-3 bg-white border-b border-gray-200">
                <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">
            {{ __('Modifier la demande') }}
        </h2>
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    <form method="POST" action="{{ route('loan_requests.update', $loanRequest->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                            <select id="type" name="type" class="form-select mt-1 block w-full">
                                <option value="Prêt" {{ $loanRequest->type === 'Prêt' ? 'selected' : '' }}>Prêt</option>
                                <option value="Avances" {{ $loanRequest->type === 'Avances' ? 'selected' : '' }}>Avances</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                            <input id="amount" name="amount" type="text" class="form-select mt-1 block w-full" value="{{ $loanRequest->amount }}" required>
                        </div>
                       <!-- <form method="POST" action="{{ route('loan_requests.update_status', ['loanRequest' => $loanRequest->id]) }}">
                            @csrf
                            <div class="mb-4">
                                <label for="status" class="block text-sm font-medium text-gray-700">Statut</label>
                                <select id="status" name="status" class="form-select mt-1 block w-full">
                                    <option value="En attente" {{ $loanRequest->status === 'En attente' ? 'selected' : '' }}>En attente</option>
                                    <option value="Approuvé" {{ $loanRequest->status === 'Approuvé' ? 'selected' : '' }}>Approuvé</option>
                                    <option value="Rejeté" {{ $loanRequest->status === 'Rejeté' ? 'selected' : '' }}>Rejeté</option>
                                </select>
                            </div>-->
                        <div class="mb-4">
                            <label for="comments" class="block text-sm font-medium text-gray-700">Comments</label>
                            <textarea id="comments" name="comments" class="form-select mt-1 block w-full">{{ $loanRequest->comments }}</textarea>
                        </div>
                        <div class="flex items-center justify-end mt-4 float-end">
                            <button type="submit" class="btn btn-primary">Modifier</button>
                      
                    
                            <a href="{{ route('loan_requests.index') }}" class="btn btn-secondary">Retour a la liste</a>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
@endsection