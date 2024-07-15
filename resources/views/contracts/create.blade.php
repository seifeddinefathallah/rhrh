<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Créer un Contrat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('contracts.store') }}">
                        @csrf
                        <!-- Pays -->
                        <div class="form-group row">
                            <label for="pays" class="col-md-4 col-form-label text-md-right">{{ __('Pays') }}</label>
                            <div class="col-md-6">
                                <select id="pays" class="form-control @error('pays') is-invalid @enderror" name="pays" required autocomplete="pays" autofocus>
                                    <option value="">Choisir le pays</option>
                                    <option value="Tunisie">Tunisie</option>
                                    <option value="France">France</option>
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

                        <!-- Début du Contrat -->
                        <div class="form-group row" id="debut-contrat-field">
                            <label for="debut_contrat" class="col-md-4 col-form-label text-md-right">{{ __('Début du Contrat') }}</label>
                            <div class="col-md-6">
                                <input id="debut_contrat" type="date" class="form-control @error('debut_contrat') is-invalid @enderror" name="debut_contrat" required autocomplete="debut_contrat">
                                @error('debut_contrat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Fin du Contrat -->
                        <div class="form-group row" id="fin-contrat-field">
                            <label for="fin_contrat" class="col-md-4 col-form-label text-md-right">{{ __('Fin du Contrat') }}</label>
                            <div class="col-md-6">
                                <input id="fin_contrat" type="date" class="form-control @error('fin_contrat') is-invalid @enderror" name="fin_contrat" autocomplete="fin_contrat" >
                                @error('fin_contrat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Durée du Contrat -->
                        <div class="form-group row" id="duree-contrat-field">
                            <label for="duree_contrat" class="col-md-4 col-form-label text-md-right">{{ __('Durée du Contrat') }}</label>
                            <div class="col-md-6">
                                <input id="duree_contrat" type="text" class="form-control @error('duree_contrat') is-invalid @enderror" name="duree_contrat" autocomplete="duree_contrat" readonly>
                                @error('duree_contrat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Classification -->
                        <div class="form-group row" id="classification-field" style="display: none;">
                            <label for="classification" class="col-md-4 col-form-label text-md-right">{{ __('Classification') }}</label>
                            <div class="col-md-6">
                                <select id="classification" class="form-control @error('classification') is-invalid @enderror" name="classification">
                                    <option value="">Choisir une classification</option>
                                    <option value="ETAM">Employés, Techniciens et Agents de Maîtrise "ETAM"</option>
                                    <option value="Ingénieurs et Cadres">Ingénieurs et Cadres</option>
                                </select>
                                @error('classification')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Coefficient -->
                        <div class="form-group row" id="coefficient-field" style="display: none;">
                            <label for="coefficient" class="col-md-4 col-form-label text-md-right">{{ __('Coefficient') }}</label>
                            <div class="col-md-6">
                                <input id="coefficient" type="number" class="form-control @error('coefficient') is-invalid @enderror" name="coefficient" autocomplete="coefficient">
                                @error('coefficient')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>

                        <!-- Période d'Essai Initiale -->
                        <div class="form-group row">
                            <label for="periode_essai_initiale" class="col-md-4 col-form-label text-md-right">{{ __('Période d\'Essai Initiale') }}</label>
                            <div class="col-md-6">
                                <input id="periode_essai_initiale" type="text" class="form-control @error('periode_essai_initiale') is-invalid @enderror" name="periode_essai_initiale" autocomplete="periode_essai_initiale">
                                @error('periode_essai_initiale')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Liste déroulante pour sélectionner un employé -->
                        <div class="form-group row">
                            <label for="employee_id" class="col-md-4 col-form-label text-md-right">{{ __('Sélectionner un employé') }}</label>
                            <div class="col-md-6">
                                <select id="employee_id" class="form-control @error('employee_id') is-invalid @enderror" name="employee_id">
                                    <option value="">Choisir un employé</option>
                                    @foreach ($employees as $emp)
                                    <option value="{{ $emp->id }}">{{ $emp->nom }} {{ $emp->prenom }}</option>
                                    @endforeach
                                </select>
                                @error('employee_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Bouton de soumission -->
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Créer') }}
                                </button>
                            </div>
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
            var debutContratField = document.getElementById('debut-contrat-field');
            var finContratField = document.getElementById('fin-contrat-field');
            var dureeContratField = document.getElementById('duree-contrat-field');
            var classificationField = document.getElementById('classification-field');
            var coefficientField = document.getElementById('coefficient-field');

            // Définir la date minimale pour début_contrat et fin_contrat
            function getTodayDate() {
                var today = new Date();
                var day = ("0" + today.getDate()).slice(-2);
                var month = ("0" + (today.getMonth() + 1)).slice(-2);
                var year = today.getFullYear();
                return year + "-" + month + "-" + day;
            }
            document.getElementById('debut_contrat').setAttribute('min', getTodayDate());
            document.getElementById('fin_contrat').setAttribute('min', getTodayDate());

            // Options de types de contrats selon le pays sélectionné
            var contratsParPays = {
                'Tunisie': [
                    { value: 'CDI', label: 'Contrat à Durée Indéterminée (CDI)' },
                    { value: 'CDD', label: 'Contrat à Durée Déterminée (CDD)' },
                    { value: 'CIVP', label: 'Contrat d’Insertion à la Vie Professionnelle (CIVP)' },
                    { value: 'PFE', label: 'Stage Projet de Fin d’Études (PFE)' },
                    { value: 'Stage', label: 'Stage' },
                    { value: 'Freelance', label: 'Freelance' }
                ],
                'France': [
                    { value: 'CDI', label: 'Contrat à Durée Indéterminée (CDI)' },
                    { value: 'CDD', label: 'Contrat à Durée Déterminée (CDD)' },
                    { value: 'CIVP', label: 'Contrat d’Insertion à la Vie Professionnelle (CIVP)' },
                    { value: 'Interim', label: 'Contrat de Travail Temporaire (Intérim)' },
                    { value: 'TempsPartiel', label: 'Contrat à Temps Partiel' },
                    { value: 'PFE', label: 'Stage Projet de Fin d’Études (PFE)' },
                    { value: 'Stage', label: 'Stage' },
                    { value: 'Freelance', label: 'Freelance' }
                ]
            };

            // Mise à jour des options de type de contrat selon le pays sélectionné
            paysSelect.addEventListener('change', function() {
                var selectedPays = this.value;
                var options = contratsParPays[selectedPays] || [];
                typeSelect.innerHTML = '<option value="">Choisir le type de contrat</option>';
                options.forEach(function(option) {
                    var optionElement = document.createElement('option');
                    optionElement.value = option.value;
                    optionElement.textContent = option.label;
                    typeSelect.appendChild(optionElement);
                });
            });

            // Affichage conditionnel des champs selon le type de contrat sélectionné et le pays
            typeSelect.addEventListener('change', function() {
                var selectedType = this.value;
                var selectedPays = paysSelect.value;

                if (selectedPays === 'France') {
                    if (selectedType === 'CDI') {
                        // Afficher tous les champs sauf "Fin du Contrat" et "Période d'Essai Initiale"
                        finContratField.style.display = 'none';
                        dureeContratField.style.display = 'none';
                        classificationField.style.display = 'block';
                        coefficientField.style.display = 'block';
                        periodeEssaiInitialeField.style.display = 'block';

                        periodeEssaiInitialeField.style.display = 'none';
                    } else {
                        // Afficher tous les champs pour les autres types de contrat en France
                        finContratField.style.display = 'block';
                        dureeContratField.style.display = 'block';
                        classificationField.style.display = 'block';
                        coefficientField.style.display = 'block';
                        periodeEssaiInitialeField.style.display = 'block';
                    }
                } else {
                    // Affichage basé sur le type de contrat pour les autres pays
                    if (selectedType === 'CDI') {
                        finContratField.style.display = 'none';
                        dureeContratField.style.display = 'none';
                        classificationField.style.display = 'none';
                        coefficientField.style.display = 'none';
                        periodeEssaiInitialeField.style.display = 'none';
                    } else if (selectedType === 'CDD' || selectedType === 'CIVP' || selectedType === 'PFE' || selectedType === 'Alternance') {
                        finContratField.style.display = 'block';
                        dureeContratField.style.display = 'block';
                        classificationField.style.display = 'none';
                        coefficientField.style.display = 'none';
                        periodeEssaiInitialeField.style.display = 'block';
                    } else {
                        finContratField.style.display = 'block';
                        dureeContratField.style.display = 'block';
                        classificationField.style.display = 'none';
                        coefficientField.style.display = 'none';
                        periodeEssaiInitialeField.style.display = 'none';
                    }
                }


            });


            // Validation de la saisie du coefficient pour la classification ETAM
            document.getElementById('classification').addEventListener('change', function() {
                var selectedClassification = this.value;
                if (selectedClassification === 'ETAM') {
                    coefficientField.style.display = 'block';
                    document.getElementById('coefficient').setAttribute('min', 240);
                    document.getElementById('coefficient').setAttribute('max', 500);
                } else {
                    coefficientField.style.display = 'block';
                }
            });

            // Calcul de la durée du contrat en années et mois
            function calculateContractDuration() {
                var debutContrat = new Date(document.getElementById('debut_contrat').value);
                var finContrat = new Date(document.getElementById('fin_contrat').value);
                if (debutContrat && finContrat && finContrat > debutContrat) {
                    var duration = new Date(finContrat - debutContrat);
                    var years = duration.getUTCFullYear() - 1970;
                    var months = duration.getUTCMonth();
                    document.getElementById('duree_contrat').value = years + ' ans, ' + months + ' mois';
                } else {
                    document.getElementById('duree_contrat').value = '';
                }
            }

            // Écouter les changements des dates de début et de fin de contrat pour calculer la durée automatiquement
            document.getElementById('debut_contrat').addEventListener('change', calculateContractDuration);
            document.getElementById('fin_contrat').addEventListener('change', calculateContractDuration);
        });
    </script>
</x-app-layout>
