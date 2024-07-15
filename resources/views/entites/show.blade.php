<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Informations sur l'entité
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p><strong>Nom :</strong> {{ $entite->nom }}</p>
                    <p><strong>Numéro Fiscal :</strong> {{ $entite->numero_fiscal }}</p>
                    <p><strong>Adresse :</strong> {{ $entite->adresse }}</p>
                    <p><strong>Pays :</strong> {{ $entite->pays }}</p>
                    <p><strong>Contact :</strong> {{ $entite->contact }}</p>
                    <p><strong>Nom de l'employeur :</strong> {{ $entite->nom_employeur }}</p>
                    <p><strong>Adresse de l'employeur :</strong> {{ $entite->adresse_employeur }}</p>
                    <p><strong>Numéro SIRET :</strong> {{ $entite->numero_siret }}</p>
                    <p><strong>Code APE/NAF :</strong> {{ $entite->code_ape_naf }}</p>
                    <p><strong>Convention Collective :</strong> {{ $entite->convention_collective }}</p>
                    <p><strong>Identifiant de l’établissement :</strong> {{ $entite->identifiant_etablissement }}</p>

                    <a href="{{ route('entites.index') }}" class="text-blue-600 hover:text-blue-900">Retour à la liste</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
