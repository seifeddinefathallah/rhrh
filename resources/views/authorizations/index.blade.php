<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Authorization Requests') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <a href="{{ route('authorizations.create') }}" class="btn btn-success">Create Authorizations</a>
                    </div>
                    <div class="mb-4">
                        <a href="{{ route('authorizations.update-temporary-balances') }}" class="btn btn-success">Personaliser Authorizations</a>
                    </div>
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
                                Start Date
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                End Date
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Duration Type
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Duration
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($authorizations as $authorization)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($authorization->employee)
                                {{ $authorization->employee->prenom }} {{ $authorization->employee->nom }}
                                @else
                                N/A <!-- Display N/A or handle as per your design if employee is null -->
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $authorization->type }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($authorization->start_date)->format('Y-m-d') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($authorization->end_date)->format('Y-m-d') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ ucfirst($authorization->duration_type) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $authorization->duration }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($authorization->status === 'pending')
                                <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs">{{ ucfirst($authorization->status) }}</span>
                                @elseif ($authorization->status === 'approved')
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">{{ ucfirst($authorization->status) }}</span>
                                @elseif ($authorization->status === 'rejected')
                                <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs">{{ ucfirst($authorization->status) }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('authorizations.show', $authorization->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">View</a>
                                <a href="{{ route('authorizations.edit', $authorization->id) }}" class="text-blue-600 hover:text-blue-900 mr-2">Edit</a>
                                <form action="{{ route('authorizations.destroy', $authorization->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette demande ?')">Delete</button>
                                </form>
                                <form action="{{ route('authorizations.approve', $authorization->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-green-600 hover:text-green-900" onclick="return confirm('Êtes-vous sûr de vouloir approuve cette demande ?')">Approve</button>

                                </form>
                                <form method="POST" action="{{ route('authorizations.reject', $authorization->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Êtes-vous sûr de vouloir rejeter cette demande ?')">Reject</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $authorizations->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
