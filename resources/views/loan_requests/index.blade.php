<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Les demandes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <a href="{{ route('loan_requests.create') }}" class="btn btn-success">Create Loan</a>
                    </div>
                    @if ($loanRequests && count($loanRequests) > 0)
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Employé
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Type
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Montant
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Statut
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Commentaires
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($loanRequests as $loanRequest)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($loanRequest->employee)
                                {{ $loanRequest->employee->prenom }} {{ $loanRequest->employee->nom }}
                                @else
                                N/A <!-- Display N/A or handle as per your design if employee is null -->
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $loanRequest->type }}
                            </td>
                            <td>
                                {{ number_format($loanRequest->amount, 2) }}
                                @if($loanRequest->currency === 'TND')
                                TND
                                @else
                                €
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($loanRequest->status === 'En attente')
                                <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs">{{ ucfirst($loanRequest->status) }}</span>
                                @elseif ($loanRequest->status === 'Approuvé')
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">{{ ucfirst($loanRequest->status) }}</span>
                                @elseif ($loanRequest->status === 'Rejeté')
                                <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs">{{ ucfirst($loanRequest->status) }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $loanRequest->comments }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($loanRequest->created_at)->format('Y-m-d') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('loan_requests.show', $loanRequest->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">View</a>
                                <a href="{{ route('loan_requests.edit', $loanRequest->id) }}" class="text-blue-600 hover:text-blue-900 mr-2">Edit</a>
                                <form action="{{ route('loan_requests.destroy', $loanRequest->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette demande ?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @else
                    <p>Aucune demande trouvée.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
