<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modifier le Contrat
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('contracts.update', $contract->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Pays -->
                        <div class="form-group row">
                            <label for="pays" class="col-md-4 col-form-label text-md-right">{{ __('Pays') }}</label>
                            <div class="col-md-6">
                                <select id="pays" class="form-control @error('pays') is-invalid @enderror" name="pays" required autocomplete="pays" autofocus>
                                    <option value="">Choisir le pays</option>
                                    <option value="Tunisie" {{ old('pays', $contract->pays) == 'Tunisie' ? 'selected' : '' }}>Tunisie</option>
                                    <option value="France" {{ old('pays', $contract->pays) == 'France' ? 'selected' : '' }}>France</option>
                                </select>
                                @error('pays')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Type de contrat -->
                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Type de contrat') }}</label>
                            <div class="col-md-6">
                                <select id="type" class="form-control @error('type') is-invalid @enderror" name="type" required autocomplete="type">
                                    <option value="">Choisir le type de contrat</option>
                                    <!-- Options de contrat dynamiques selon le pays sélectionné -->
                                </select>
                                @error('type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="mb-4">
                            <label for="classification" class="block text-sm font-medium text-gray-700">Classification</label>
                            <input type="text" name="classification" id="classification" value="{{ old('classification', $contract->classification) }}" class="form-input mt-1 block w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="coefficient" class="block text-sm font-medium text-gray-700">Coefficient</label>
                            <input type="number" name="coefficient" id="coefficient" value="{{ old('coefficient', $contract->coefficient) }}" class="form-input mt-1 block w-full">
                        </div>

                        <div class="mb-4">
                            <label for="periode_essai_initiale" class="block text-sm font-medium text-gray-700">Période d'Essai Initiale</label>
                            <input type="text" name="periode_essai_initiale" id="periode_essai_initiale" value="{{ old('periode_essai_initiale', $contract->periode_essai_initiale) }}" class="form-input mt-1 block w-full">
                        </div>

                        <div class="mb-4">
                            <label for="renouvellement" class="block text-sm font-medium text-gray-700">Renouvellement</label>
                            <input type="date" name="renouvellement" id="renouvellement" class="mt-1 block w-full">
                        </div>
                        <div class="mb-4">
                            <label for="duree_contrat" class="block text-sm font-medium text-gray-700">Durée du Contrat</label>
                            <input type="text" name="duree_contrat" id="duree_contrat" value="{{ old('duree_contrat', $contract->duree_contrat) }}" class="form-input mt-1 block w-full">
                        </div>

                        <div class="mb-4">
                            <label for="limite_contrat" class="block text-sm font-medium text-gray-700">Limite du Contrat</label>
                            <input type="text" name="limite_contrat" id="limite_contrat" value="{{ old('limite_contrat', $contract->limite_contrat) }}" class="form-input mt-1 block w-full">
                        </div>

                        <div class="flex items-center mt-6">
                            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                            <a href="{{ route('contracts.index') }}" class="btn btn-secondary ml-4">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var typeSelect = document.getElementById('type');
            var paysSelect = document.getElementById('pays');

            // Options de contrat par pays
            var contratsParPays = {
                'Tunisie': [
                    { value: 'CDI', label: 'Contrat à Durée Indéterminée (CDI)' },
                    { value: 'CDD', label: 'Contrat à Durée Déterminée (CDD)' },
                    { value: 'CIVP', label: 'Contrat d’Insertion à la Vie Professionnelle (CIVP)' },
                    { value: 'PFE', label: 'Stage / Projet de Fin d’Études (PFE)' },
                    { value: 'Freelance', label: 'Freelance' }
                ],
                'France': [
                    { value: 'Interim', label: 'Contrat de Travail Temporaire (Intérim)' },
                    { value: 'TempsPartiel', label: 'Contrat à Temps Partiel' }
                    // Ajouter d'autres types de contrat pour la France si nécessaire
                ]
            };

            // Fonction pour mettre à jour les options du type de contrat en fonction du pays sélectionné
            function updateTypeOptions(selectedPays) {
                // Nettoyer les options existantes
                typeSelect.innerHTML = '<option value="">Choisir le type de contrat</option>';

                // Obtenir les types de contrat pour le pays sélectionné
                var contrats = contratsParPays[selectedPays] || [];

                // Ajouter les options au menu déroulant
                contrats.forEach(function(contrat) {
                    var option = document.createElement('option');
                    option.value = contrat.value;
                    option.textContent = contrat.label;
                    typeSelect.appendChild(option);
                });
            }

            // Écouter les changements sur la sélection du pays
            paysSelect.addEventListener('change', function() {
                var selectedPays = paysSelect.value;
                updateTypeOptions(selectedPays);
            });

            // Déclencher l'événement 'change' au chargement pour initialiser les options
            paysSelect.dispatchEvent(new Event('change'));
        });
    </script>


</x-app-layout>
