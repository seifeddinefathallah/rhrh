<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Loan Request') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <a href="{{ route('loan_requests.index') }}" class="btn btn-secondary">Back to Loan Requests</a>
                    </div>
                    <div>
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Loan Request Details</h3>
                        <div class="mt-5">
                            <p><strong>Type:</strong> {{ $loanRequest->type }}</p>
                            <p><strong>Montant:</strong> {{ number_format($loanRequest->amount, 2) }}
                                @if($loanRequest->currency === 'TND')
                                TND
                                @else
                                €
                                @endif
                            </p>
                            <p><strong>Statut:</strong>
                                @if ($loanRequest->status === 'En attente')
                                <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs">{{ ucfirst($loanRequest->status) }}</span>
                                @elseif ($loanRequest->status === 'Approuvé')
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">{{ ucfirst($loanRequest->status) }}</span>
                                @elseif ($loanRequest->status === 'Rejeté')
                                <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs">{{ ucfirst($loanRequest->status) }}</span>
                                @endif
                            </p>
                            <p><strong>Commentaires:</strong> {{ $loanRequest->comments }}</p>
                            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($loanRequest->created_at)->format('Y-m-d') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
