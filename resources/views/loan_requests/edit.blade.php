<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Loan Request') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <a href="{{ route('loan_requests.index') }}" class="btn btn-secondary">Back to Loan Requests</a>
                    </div>
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
                            <input id="amount" name="amount" type="text" class="form-input mt-1 block w-full" value="{{ $loanRequest->amount }}" required>
                        </div>
                        <form method="POST" action="{{ route('loan_requests.update_status', ['loanRequest' => $loanRequest->id]) }}">
                            @csrf
                            <div class="mb-4">
                                <label for="status" class="block text-sm font-medium text-gray-700">Statut</label>
                                <select id="status" name="status" class="form-select mt-1 block w-full">
                                    <option value="En attente" {{ $loanRequest->status === 'En attente' ? 'selected' : '' }}>En attente</option>
                                    <option value="Approuvé" {{ $loanRequest->status === 'Approuvé' ? 'selected' : '' }}>Approuvé</option>
                                    <option value="Rejeté" {{ $loanRequest->status === 'Rejeté' ? 'selected' : '' }}>Rejeté</option>
                                </select>
                            </div>
                        <div class="mb-4">
                            <label for="comments" class="block text-sm font-medium text-gray-700">Comments</label>
                            <textarea id="comments" name="comments" class="form-textarea mt-1 block w-full">{{ $loanRequest->comments }}</textarea>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
