<!-- resources/views/employees/edit.blade.php -->

    @extends('layouts.app')

    @section('content')
    <div class="layout-container" style="width: 85%; position: relative; left: 16%;">
            <div class=" container-xxl flex-grow-1 container-p-y">  
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Employee') }}
        </h2>
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('employees.update', $employee->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Form Fields for Employee Details -->
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom', $employee->nom) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="prenom" class="form-label">Prénom</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" value="{{ old('prenom', $employee->prenom) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="date_naissance" class="form-label">Date de Naissance</label>
                            <input type="date" class="form-control" id="date_naissance" name="date_naissance" value="{{ old('date_naissance', $employee->date_naissance) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email_professionnel" class="form-label">Email Professionnel</label>
                            <input type="email" class="form-control" id="email_professionnel" name="email_professionnel" value="{{ old('email_professionnel', $employee->email_professionnel) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email_personnel" class="form-label">Email Personnel</label>
                            <input type="email" class="form-control" id="email_personnel" name="email_personnel" value="{{ old('email_personnel', $employee->email_personnel) }}">
                        </div>

                        <div class="mb-3">
                            <label for="matricule" class="form-label">Matricule</label>
                            <input type="text" class="form-control" id="matricule" name="matricule" value="{{ old('matricule', $employee->matricule) }}" required>
                        </div>

                        <!-- Country Dropdown 
                        <div class="mb-3">
                            <label for="pays" class="form-label">Pays</label>
                            <select class="form-control country" id="pays" name="pays" required>
                                <option value="">choisir pays</option>-->
                                <!-- Populate options dynamically 
                            </select>
                        </div>-->

                        <!-- State Dropdown 
                        <div class="mb-3">
                            <label for="state" class="form-label">Ville</label>
                            <select class="form-control state" id="state" name="state" required>
                                <option value="">choisir ville</option>-->
                                <!-- Populate options dynamically
                            </select>
                        </div> -->

                        <!-- City Dropdown 
                        <div class="mb-3">
                            <label for="ville" class="form-label">État</label>
                            <select class="form-control city" id="ville" name="ville" required>
                                <option value="">choisir État</option>-->
                                <!-- Populate options dynamically
                            </select>
                        </div> -->

                        <div class="mb-3">
                            <label for="code_postal" class="form-label">Code Postal</label>
                            <input type="text" class="form-control" id="code_postal" name="code_postal" value="{{ old('code_postal', $employee->code_postal) }}">
                        </div>

                        <div class="mb-3">
                            <label for="adresse" class="form-label">Adresse</label>
                            <input type="text" class="form-control" id="adresse" name="adresse" value="{{ old('adresse', $employee->adresse) }}" required>
                        </div>

                        <div class="mb-3 phone-input">
                            <label for="telephone" class="form-label">Téléphone</label>
                            <input type="tel" class="form-control" id="telephone" name="telephone" value="{{ old('telephone', $employee->telephone) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="situation_familiale" class="form-label">Situation Familiale</label>
                            <input type="text" class="form-control" id="situation_familiale" name="situation_familiale" value="{{ old('situation_familiale', $employee->situation_familiale) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="nombre_enfants" class="form-label">Nombre d'Enfants</label>
                            <input type="number" class="form-control" id="nombre_enfants" name="nombre_enfants" value="{{ old('nombre_enfants', $employee->nombre_enfants) }}" required>
                        </div>

                        <!-- Additional fields (CIN, Carte de Séjour, Passeport) -->
                        <div class="mb-4">
                            <label for="cin_numero" class="block text-sm font-medium text-gray-700">CIN Numéro</label>
                            <input type="text" name="cin_numero" id="cin_numero" class="form-control" value="{{ old('cin_numero', $employee->cin_numero) }}">
                        </div>

                        <div class="mb-4">
                            <label for="cin_date_delivrance" class="block text-sm font-medium text-gray-700">CIN Date Délivrance</label>
                            <input type="date" name="cin_date_delivrance" id="cin_date_delivrance" class="form-control" value="{{ old('cin_date_delivrance', $employee->cin_date_delivrance) }}">
                        </div>

                        <div class="mb-4">
                            <label for="carte_sejour_numero" class="block text-sm font-medium text-gray-700">Carte de Séjour Numéro</label>
                            <input type="text" name="carte_sejour_numero" id="carte_sejour_numero" class="form-control" value="{{ old('carte_sejour_numero', $employee->carte_sejour_numero) }}">
                        </div>

                        <div class="mb-4">
                            <label for="carte_sejour_date_delivrance" class="block text-sm font-medium text-gray-700">Carte de Séjour Date Délivrance</label>
                            <input type="date" name="carte_sejour_date_delivrance" id="carte_sejour_date_delivrance" class="form-control" value="{{ old('carte_sejour_date_delivrance', $employee->carte_sejour_date_delivrance) }}">
                        </div>

                        <div class="mb-4">
                            <label for="carte_sejour_date_expiration" class="block text-sm font-medium text-gray-700">Carte de Séjour Date Expiration</label>
                            <input type="date" name="carte_sejour_date_expiration" id="carte_sejour_date_expiration" class="form-control" value="{{ old('carte_sejour_date_expiration', $employee->carte_sejour_date_expiration) }}">
                        </div>

                        <div class="mb-4">
                            <label for="carte_sejour_type" class="block text-sm font-medium text-gray-700">Carte de Séjour Type</label>
                            <input type="text" name="carte_sejour_type" id="carte_sejour_type" class="form-control" value="{{ old('carte_sejour_type', $employee->carte_sejour_type) }}">
                        </div>

                        <div class="mb-4">
                            <label for="passeport_numero" class="block text-sm font-medium text-gray-700">Passeport Numéro</label>
                            <input type="text" name="passeport_numero" id="passeport_numero" class="form-control" value="{{ old('passeport_numero', $employee->passeport_numero) }}">
                        </div>

                        <div class="mb-4">
                            <label for="passeport_date_delivrance" class="block text-sm font-medium text-gray-700">Passeport Date Délivrance</label>
                            <input type="date" name="passeport_date_delivrance" id="passeport_date_delivrance" class="form-control" value="{{ old('passeport_date_delivrance', $employee->passeport_date_delivrance) }}">
                        </div>

                        <div class="mb-4">
                            <label for="passeport_date_expiration" class="block text-sm font-medium text-gray-700">Passeport Date Expiration</label>
                            <input type="date" name="passeport_date_expiration" id="passeport_date_expiration" class="form-control" value="{{ old('passeport_date_expiration', $employee->passeport_date_expiration) }}">
                        </div>

                        <div class="mb-4">
                            <label for="passeport_delai_validite" class="block text-sm font-medium text-gray-700">Passeport Délai Validité</label>
                            <input type="text" name="passeport_delai_validite" id="passeport_delai_validite" class="form-control" value="{{ old('passeport_delai_validite', $employee->passeport_delai_validite) }}">
                        </div>

                        <!-- Entity Dropdown -->
                        <div class="mb-3">
                            <label for="entite_id" class="form-label">Entité</label>
                            <select class="form-control" id="entite_id" name="entite_id" required>
                                <option value="">Select Entity</option>
                                @foreach($entites as $entite)
                                <option value="{{ $entite->id }}" {{ $employee->entite_id == $entite->id ? 'selected' : '' }}>{{ $entite->nom }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Department Dropdown -->
                        <div class="mb-3">
                            <label for="departement_id" class="form-label">Département</label>
                            <select class="form-control" id="departement_id" name="departement_id" required>
                                <option value="">Select Department</option>
                                <!-- Populate options dynamically based on selected entity -->
                            </select>
                        </div>

                        <!-- Position Dropdown -->
                        <div class="mb-3">
                            <label for="poste_id" class="form-label">Poste</label>
                            <select class="form-control" id="poste_id" name="poste_id" required>
                                <option value="">Select Position</option>
                                <!-- Populate options dynamically based on selected department -->
                            </select>
                        </div>

                        <!-- Contract Information Section -->
                        <div class="border mb-4 p-4">
                            <h3 class="text-lg font-semibold mb-2">Contrat</h3>
                                                  <!-- Liste déroulante pour sélectionner un CONTRAT -->
  <div class="form-group row">
    <label for="contract_type_id" class="col-md-4 col-form-label text-md-right">{{ __('Sélectionner un contract_type') }}</label>
    <div class="col-md-6">
        <select name="contract_type_id" class="form-control" id="contract_type_id" required>
            @foreach($contractTypes as $contractType)
                <option value="{{ $contractType->id }}">{{ $contractType->description }}</option>
            @endforeach
        </select>
        @error('contract_type_id')
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
                                <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Modifier</button>

                        <a href="{{ route('employees.index') }}" class="btn btn-primary">Retour à la liste</a>
                                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
    <script>
        // Assuming you have a way to fetch or determine USER_ID dynamically

        OneSignal.push(function() {
            OneSignal.sendTags({
                user_id: USER_ID
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const entiteSelect = document.getElementById('entite_id');
            const departementSelect = document.getElementById('departement_id');
            const posteSelect = document.getElementById('poste_id');

            // Load departments based on selected entity on page load
            entiteSelect.addEventListener('change', function () {
                const entiteId = this.value;
                fetch(`/entites/${entiteId}/departements`)
                    .then(response => response.json())
                    .then(data => {
                        departementSelect.innerHTML = '';
                        data.forEach(departement => {
                            const option = document.createElement('option');
                            option.value = departement.id;
                            option.textContent = departement.nom;
                            departementSelect.appendChild(option);
                        });

                        // Trigger change event on page load if default value is selected
                        if (departementSelect.value) {
                            departementSelect.dispatchEvent(new Event('change'));
                        }
                    })
                    .catch(error => console.error('Error fetching departements', error));
            });

            // Load positions based on selected department on change
            departementSelect.addEventListener('change', function () {
                const departementId = this.value;
                fetch(`/departements/${departementId}/postes`)
                    .then(response => response.json())
                    .then(data => {
                        posteSelect.innerHTML = '';
                        data.forEach(poste => {
                            const option = document.createElement('option');
                            option.value = poste.id;
                            option.textContent = poste.titre;
                            posteSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error fetching postes', error));
            });

            // Trigger change event on page load if default value is selected
            if (entiteSelect.value) {
                entiteSelect.dispatchEvent(new Event('change'));
            }
        });
    </script>
    <script>
        var config = {
            cUrl: 'https://api.countrystatecity.in/v1',
            ckey: 'NHhvOEcyWk50N2Vna3VFTE00bFp3MjFKR0ZEOUhkZlg4RTk1MlJlaA=='
        }

        var countrySelect = document.getElementById('pays'),
            stateSelect = document.getElementById('state'),
            citySelect = document.getElementById('ville'),
            postalCodeInput = document.getElementById('code_postal');

        function loadCountries() {
            let apiEndPoint = config.cUrl + '/countries';

            fetch(apiEndPoint, {
                headers: {
                    "X-CSCAPI-KEY": config.ckey
                }
            })
                .then(response => response.json())
                .then(data => {
                    data.forEach(country => {
                        const option = document.createElement('option');
                        option.value = country.iso2;
                        option.textContent = country.name;
                        countrySelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error loading countries:', error));

            stateSelect.disabled = true;
            citySelect.disabled = true;
            stateSelect.style.pointerEvents = 'none';
            citySelect.style.pointerEvents = 'none';
        }

        function loadStates() {
            stateSelect.disabled = false;
            citySelect.disabled = true;
            stateSelect.style.pointerEvents = 'auto';
            citySelect.style.pointerEvents = 'none';

            const selectedCountryCode = countrySelect.value;
            stateSelect.innerHTML = '<option value="">choisir ville</option>'; // Clear existing states
            citySelect.innerHTML = '<option value="">choisir État</option>'; // Clear existing city options

            fetch(`${config.cUrl}/countries/${selectedCountryCode}/states`, {
                headers: {
                    "X-CSCAPI-KEY": config.ckey
                }
            })
                .then(response => response.json())
                .then(data => {
                    data.forEach(state => {
                        const option = document.createElement('option');
                        option.value = state.iso2;
                        option.textContent = state.name;
                        stateSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error loading states:', error));
        }

        function loadCities() {
            citySelect.disabled = false;
            citySelect.style.pointerEvents = 'auto';

            const selectedCountryCode = countrySelect.value;
            const selectedStateCode = stateSelect.value;
            citySelect.innerHTML = '<option value="">choisir État</option>'; // Clear existing city options

            fetch(`${config.cUrl}/countries/${selectedCountryCode}/states/${selectedStateCode}/cities`, {
                headers: {
                    "X-CSCAPI-KEY": config.ckey
                }
            })
                .then(response => response.json())
                .then(data => {
                    data.forEach(city => {
                        const option = document.createElement('option');
                        option.value = city.name;
                        option.textContent = city.name;
                        citySelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error loading cities:', error));
        }

        function loadPostalCodes() {
            const selectedCity = citySelect.value;

            fetch(`${config.cUrl}/cities/${selectedCity}/postal-codes`, {
                headers: {
                    "X-CSCAPI-KEY": config.ckey
                }
            })
                .then(response => response.json())
                .then(data => {
                    console.log('Postal code data:', data); // Vérifiez les données de code postal reçues
                    if (data.length > 0) {
                        postalCodeInput.value = data[0].postal_code; // Remplissez le champ code postal
                    } else {
                        postalCodeInput.value = ''; // Si aucun code postal n'est trouvé
                    }
                })
                .catch(error => {
                    console.error('Error loading postal codes:', error);
                    postalCodeInput.value = ''; // Gestion des erreurs
                });
        }

        window.onload = function () {
            loadCountries();
        };

        countrySelect.addEventListener('change', loadStates);
        stateSelect.addEventListener('change', function () {
            loadCities();
            postalCodeInput.value = ''; // Clear postal code when state changes
        });
        citySelect.addEventListener('change', loadPostalCodes);
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">

    <!-- Include intl-tel-input JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

    <script>
        // Initialize intl-tel-input on phone-input field
        var input = document.querySelector(".phone-input input[type='tel']");
        var iti = window.intlTelInput(input, {
            initialCountry: "auto",
            separateDialCode: true,
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        });

        // Set a listener to update the hidden input value when the user selects a country
        input.addEventListener('countrychange', function () {
            var countryData = iti.getSelectedCountryData();
            var dialCode = countryData.dialCode;
            document.getElementById('telephone').value = dialCode + ' '; // Add space after dial code
        });
    </script>

<script>
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
   
               </script>

@endsection
