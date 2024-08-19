<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Détails du Contrat
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-12 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div>
                        @if (!empty($contract->type))
                        <p><strong>Type :</strong> {{ $contract->type }}</p>
                        @endif
                        @if (!empty($contract->pays))
                        <p><strong>Type :</strong> {{ $contract->pays }}</p>
                        @endif

                        @if (!empty($contract->classification))
                        <p><strong>Classification :</strong> {{ $contract->classification }}</p>
                        @endif

                        @if (!empty($contract->coefficient))
                        <p><strong>Coefficient :</strong> {{ $contract->coefficient }}</p>
                        @endif

                        @if (!empty($contract->periode_essai_initiale))
                        <p><strong>Période d'Essai Initiale :</strong> {{ $contract->periode_essai_initiale }}</p>
                        @endif

                        @if (!empty($contract->renouvellement))
                        <p><strong>Renouvellement :</strong> {{ $contract->renouvellement }}</p>
                        @endif

                        @if (!empty($contract->duree_contrat))
                        <p><strong>Durée du Contrat :</strong> {{ $contract->duree_contrat }}</p>
                        @endif

                        @if (!empty($contract->limite_contrat))
                        <p><strong>Limite du Contrat :</strong> {{ $contract->limite_contrat }}</p>
                        @endif
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('contracts.edit', $contract->id) }}" class="btn btn-primary">Modifier</a>
                        <form action="{{ route('contracts.destroy', $contract->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce contrat ?')">Supprimer</button>
                        </form>
                        <a href="{{ route('contracts.index') }}" class="btn btn-secondary">Retour à la liste</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
