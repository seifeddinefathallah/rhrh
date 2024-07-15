<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Liste des départements
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('departements.create') }}" class="btn btn-primary mb-3">Ajouter un département</a>
                </div>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <th>Nom</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($departements as $departement)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $departement->nom }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('departements.edit', $departement->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Modifier</a>
                                <form action="{{ route('departements.destroy', $departement->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce département ?')">Supprimer</button>
                                </form>
                                <a href="{{ route('departements.assign.entite.form', $departement->id) }}" class="text-green-600 hover:text-green-900 ml-2">Assigner Entités</a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
