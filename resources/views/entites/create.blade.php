<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajouter une nouvelle entité') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form action="{{ route('entites.store') }}" method="POST" class="p-6">
                    @csrf
                    <div>
                        <label>Nom :</label>
                        <input type="text" name="nom" required>
                    </div>
                    <div>
                        <label>Numéro Fiscal :</label>
                        <input type="text" name="numero_fiscal" required>
                    </div>
                    <div>
                        <label>Adresse :</label>
                        <input type="text" name="adresse" required>
                    </div>
                    <div>
                        <label>Pays :</label>
                        <input type="text" name="pays" required>
                    </div>
                    <div>
                        <label>Contact :</label>
                        <input type="text" name="contact" required>
                    </div>
                    <div>
                        <label>Nom de l'employeur :</label>
                        <input type="text" name="nom_employeur" required>
                    </div>
                    <div>
                        <label>Adresse de l'employeur :</label>
                        <input type="text" name="adresse_employeur" required>
                    </div>
                    <div>
                        <label>Numéro SIRET :</label>
                        <input type="text" name="numero_siret" required>
                    </div>
                    <div>
                        <label>Code APE/NAF :</label>
                        <input type="text" name="code_ape_naf" required>
                    </div>
                    <div>
                        <label>Convention Collective :</label>
                        <input type="text" name="convention_collective" required>
                    </div>
                    <div>
                        <label>Identifiant de l’établissement :</label>
                        <input type="text" name="identifiant_etablissement" required>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
