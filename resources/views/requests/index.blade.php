<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des demandes administratives') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    <div class="mb-4">
                        <a href="{{ route('requests.create') }}" class="btn btn-success">Create Demandes</a>
                    </div>
                    @if ($requests->count() > 0)
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
                                Statut
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Action
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($requests as $request)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $request->employee->prenom }} {{ $request->employee->nom }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $request->type }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($request->status === 'En attente'|| $request->status === 'en_attente')
                                <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs">{{ ucfirst($request->status) }}</span>
                                @elseif ($request->status === 'approuvé')
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">{{ ucfirst($request->status) }}</span>
                                @elseif ($request->status === 'rejeté')
                                <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs">{{ ucfirst($request->status) }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('requests.edit', $request->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Modifier</a>
                                <form action="{{ route('requests.destroy', $request->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette demande ?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $requests->links() }}
                    @else
                    <p>Aucune demande trouvée.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
