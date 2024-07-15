<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des entités') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('entites.create') }}" class="btn btn-primary">Ajouter une nouvelle entité</a>

                    @if ($message = Session::get('success'))
                    <div class="alert alert-success mt-2">
                        {{ $message }}
                    </div>
                    @endif

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nom
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Numéro Fiscal
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Adresse
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Pays
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($entites as $entite)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $entite->nom }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $entite->numero_fiscal }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $entite->adresse }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $entite->pays }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('entites.show', $entite) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Voir</a>
                                <a href="{{ route('entites.edit', $entite) }}" class="text-blue-600 hover:text-blue-900 mr-2">Modifier</a>
                                <form action="{{ route('entites.destroy', $entite) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette entité ?')">Supprimer</button>
                                </form>
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
