<!-- resources/views/employees/edit.blade.php -->

    @extends('layouts.app')

    @section('content')
    <div class="layout-container max-w-7xl mx-auto sm:px-6 lg:px-8" >
        <div class="container-xl flex-grow-1 container-p-y">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-3 bg-white border-b border-gray-200">
                    <h2 class="font-semibold text-xl leading-tight mb-4 text-center" style="color: #03428e;">
            {{ __('Edit Employee') }}
        </h2>
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <form id="edit-employee-form" method="POST" action="{{ route('employees.update', $employee->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <livewire:employee-notifications />
        <div class="mb-3">
            
            <label for="image">Image</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
                    <!-- Personal Information Section -->
                    <div class="border mb-4 p-4">
                        <h3 class="text-lg font-semibold mb-2">Informations Personnelles</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="mb-3">
                                <label for="nom" class="form-label">Nom</label>
                                <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom', $employee->nom) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="prenom" class="form-label">Prénom</label>
                                <input type="text" class="form-control @error('prenom') is-invalid @enderror" id="prenom" name="prenom" value="{{ old('prenom', $employee->prenom )}}" required>
                            </div>

                            <div class="mb-3">
                                <label for="date_naissance" class="form-label">Date de Naissance</label>
                                <input type="date" class="form-control @error('date_naissance') is-invalid @enderror" id="date_naissance" name="date_naissance" value="{{ old('date_naissance', $employee->date_naissance) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="email_personnel" class="form-label">Email Personnel</label>
                                <input type="email" class="form-control @error('email_personnel') is-invalid @enderror" id="email_personnel" name="email_personnel" value="{{ old('email_personnel', $employee->email_personnel) }}">
                            </div>

                            <div class="mb-3 phone-input">
                                <label for="telephone" class="form-label">Téléphone</label>
                                <input type="tel" class="form-control @error('telephone') is-invalid @enderror" id="telephone" name="telephone" value="{{ old('telephone', $employee->telephone) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="situation_familiale" class="form-label">Situation Familiale</label>
                                <select class="form-control @error('situation_familiale') is-invalid @enderror" id="situation_familiale" name="situation_familiale" required>
                                    <option value="">Choisir la situation familiale</option>
                                    @foreach(['Célibataire', 'Marié(e)', 'Divorcé(e)', 'Veuf/Veuve'] as $situation)
                                    <option value="{{ $situation }}" {{ old('situation_familiale', $employee->situation_familiale) == $situation ? 'selected' : '' }}>
                                    {{ $situation }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>




                            <div class="mb-3">
                                <label for="nombre_enfants" class="form-label">Nombre d'Enfants</label>
                                <input type="number" class="form-control @error('nombre_enfants') is-invalid @enderror" id="nombre_enfants" name="nombre_enfants" value="{{ old('nombre_enfants', $employee->nombre_enfants) }}" required>
                            </div>
                        </div>

                    </div>

                    <!-- Professional Information Section -->
                    <div class="border mb-4 p-4">
                        <h3 class="text-lg font-semibold mb-2">Informations Professionnelles</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="mb-3">
                                <label for="email_professionnel" class="form-label">Email Professionnel</label>
                                <input type="email" class="form-control @error('email_professionnel') is-invalid @enderror" id="email_professionnel" name="email_professionnel" value="{{ old('email_professionnel', $employee->email_professionnel) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="matricule" class="form-label">Matricule</label>
                                <input type="text" class="form-control @error('matricule') is-invalid @enderror" id="matricule" name="matricule" value="{{ old('matricule', $employee->matricule) }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="entite_id" class="form-label">Entité</label>
                                <select class="form-control @error('entite_id') is-invalid @enderror" id="entite_id" name="entite_id" required>
                                    <option value="">Select Entity</option>
                                    @foreach($entites as $entite)
                                    <option value="{{ $entite->id }}" {{ old('entite_id', $employee->entite_id) == $entite->id ? 'selected' : '' }}>{{ $entite->nom }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Department Dropdown -->
                            <div class="col-md-6 mb-3">
                                <label for="departement_id" class="form-label">Département</label>
                                <select class="form-control" id="departement_id" name="departement_id" required>
                                    <option value="">Select Department</option>
                                    <!-- Populate options dynamically based on selected entity -->
                                </select>
                            </div>

                            <!-- Position Dropdown -->
                            <div class="col-md-6 mb-3">
                                <label for="poste_id" class="form-label">Poste</label>
                                <select class="form-control" id="poste_id" name="poste_id" required>
                                    <option value="">Select Position</option>
                                    <!-- Populate options dynamically based on selected department -->
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Address Information Section -->
                    <div class="border mb-4 p-4">
                        <h3 class="text-lg font-semibold mb-2">Informations de Domiciliation</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="mb-3">
                                <label for="pays" class="form-label">Pays</label>
                                <select class="form-control country" id="pays" name="pays" required>
                                    <option value="">Sélectionner le pays</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="state" class="form-label">État</label>
                                <select class="form-control state" id="state" name="state" required>
                                    <option value="">Sélectionner l'état</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="ville" class="form-label">Ville</label>
                                <select class="form-control city" id="ville" name="ville" required>
                                    <option value="">Sélectionner la ville</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="code_postal" class="form-label">Code Postal</label>
                                <input type="text" class="form-control @error('code_postal') is-invalid @enderror" id="code_postal" name="code_postal" value="{{ old('code_postal') }}">
                            </div>

                            <div class="mb-3">
                                <label for="adresse" class="form-label">Adresse</label>
                                <input type="text" class="form-control @error('adresse') is-invalid @enderror" id="adresse" name="adresse" value="{{ old('adresse') }}" required>
                            </div>
                        </div>
                    </div>

                    <!-- Identity Documents Section -->
                    <div class="border mb-4 p-4">
                        <h3 class="text-lg font-semibold mb-2">Documents d'Identité</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="mb-3">
                                <label for="cin_numero" class="form-label">Numéro de CIN</label>
                                <input type="text" class="form-control @error('cin_numero') is-invalid @enderror" id="cin_numero" name="cin_numero" value="{{ old('cin_numero',$employee->cin_numero) }}">
                            </div>

                            <div class="mb-3">
                                <label for="cin_date_delivrance" class="form-label">Date de Délivrance de CIN</label>
                                <input type="date" class="form-control @error('cin_date_delivrance') is-invalid @enderror" id="cin_date_delivrance" name="cin_date_delivrance" value="{{ old('cin_date_delivrance',$employee->cin_date_delivrance) }}">
                            </div>
                        </div>
                    </div>

                    <!-- Contact Section -->
                    <div class="border mb-4 p-4">
                        <h3 class="text-lg font-semibold mb-2">Passeport</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="mb-4">
                                <label for="passeport_numero" class="form-label">Passeport Numéro</label>
                                <input type="text" name="passeport_numero" id="passeport_numero" class="form-control @error('passeport_numero') is-invalid @enderror" value="{{ old('passeport_numero',$employee->passeport_numero) }}">
                            </div>

                            <div class="mb-4">
                                <label for="passeport_date_delivrance" class="form-label">Passeport Date Délivrance</label>
                                <input type="date" name="passeport_date_delivrance" id="passeport_date_delivrance" class="form-control @error('passeport_date_delivrance') is-invalid @enderror" value="{{ old('passeport_date_delivrance',$employee->passeport_date_delivrance) }}">
                            </div>

                            <div class="mb-4">
                                <label for="passeport_date_expiration" class="form-label">Passeport Date Expiration</label>
                                <input type="date" name="passeport_date_expiration" id="passeport_date_expiration" class="form-control @error('passeport_date_expiration') is-invalid @enderror" value="{{ old('passeport_date_expiration',$employee->passeport_date_expiration) }}">
                            </div>

                            <div class="mb-4">
                                <label for="passeport_delai_validite" class="form-label">Passport Délai de Validité (jours)</label>
                                <input type="number"  id="passeport_delai_validite" name="passeport_delai_validite" class="form-control" value="{{ old('passeport_delai_validite',$employee->passeport_delai_validite) }}" readonly>
                            </div>

                        </div>
                    </div>

                    <!-- Contact Section -->
                    <div class="border mb-4 p-4">
                        <h3 class="text-lg font-semibold mb-2">Carte de Séjour</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="mb-4">
                                <label for="carte_sejour_numero" class="form-label">Carte de Séjour Numéro</label>
                                <input type="text" name="carte_sejour_numero" id="carte_sejour_numero" class="form-control @error('carte_sejour_numero') is-invalid @enderror" value="{{ old('carte_sejour_numero',$employee->carte_sejour_numero) }}">
                            </div>

                            <div class="mb-4">
                                <label for="carte_sejour_date_delivrance" class="form-label">Carte de Séjour Date Délivrance</label>
                                <input type="date" name="carte_sejour_date_delivrance" id="carte_sejour_date_delivrance" class="form-control @error('carte_sejour_date_delivrance') is-invalid @enderror" value="{{ old('carte_sejour_date_delivrance',$employee->carte_sejour_date_delivrance) }}">
                            </div>

                            <div class="mb-4">
                                <label for="carte_sejour_date_expiration" class="form-label">Carte de Séjour Date Expiration</label>
                                <input type="date" name="carte_sejour_date_expiration" id="carte_sejour_date_expiration" class="form-control @error('carte_sejour_date_expiration') is-invalid @enderror" value="{{ old('carte_sejour_date_expiration',$employee->carte_sejour_date_expiration) }}">
                            </div>

                            <div class="mb-4">
                                <label for="carte_sejour_type" class="form-label">Carte de Séjour Type</label>
                                <input type="text" name="carte_sejour_type" id="carte_sejour_type" class="form-control @error('carte_sejour_type') is-invalid @enderror" value="{{ old('carte_sejour_type',$employee->carte_sejour_type) }}">
                            </div>
                        </div>
                    </div>
 <!-- Contact Section -->
 <div class="border mb-4 p-4">
    <h3 class="text-lg font-semibold mb-2">Carte de Séjour</h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="mb-4">
            <label for="carte_sejour_numero" class="block text-sm font-medium text-gray-700">Carte de Séjour Numéro</label>
            <input type="text" name="carte_sejour_numero" id="carte_sejour_numero" class="form-control" value="{{ old('carte_sejour_numero') }}">
        </div>

        <div class="mb-4">
            <label for="carte_sejour_date_delivrance" class="block text-sm font-medium text-gray-700">Carte de Séjour Date Délivrance</label>
            <input type="date" name="carte_sejour_date_delivrance" id="carte_sejour_date_delivrance" class="form-control" value="{{ old('carte_sejour_date_delivrance') }}">
        </div>

        <div class="mb-4">
            <label for="carte_sejour_date_expiration" class="block text-sm font-medium text-gray-700">Carte de Séjour Date Expiration</label>
            <input type="date" name="carte_sejour_date_expiration" id="carte_sejour_date_expiration" class="form-control" value="{{ old('carte_sejour_date_expiration') }}">
        </div>

        <div class="mb-4">
            <label for="carte_sejour_type" class="block text-sm font-medium text-gray-700">Carte de Séjour Type</label>
            <input type="text" name="carte_sejour_type" id="carte_sejour_type" class="form-control" value="{{ old('carte_sejour_type') }}">
        </div>
    </div>
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
            <input id="debut_contrat" type="date" class="form-control @error('debut_contrat') is-invalid @enderror" name="debut_contrat" autocomplete="debut_contrat">
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
            <input id="fin_contrat" type="date" class="form-control @error('fin_contrat') is-invalid @enderror" name="fin_contrat" autocomplete="fin_contrat">
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
</div>


                    <!-- Submit Button -->
                  
                   
                    <div class="mt-4 d-flex justify-content-end gap-2">
                        <button type="submit" id="save-button" class="btn btn-primary float-end">Modifier Employé</button>   
                        <a href="{{ route('employees.index') }}" class="btn btn-secondary float-end">Retour à la liste</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('modify-employee-button').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default form submission
            
            Swal.fire({
                title: "Do you want to save the changes?",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonColor: '#71dd37',
                cancelButtonColor: '#d33',
                denyButtonColor: '#3085d6',
                confirmButtonText: "Save",
                denyButtonText: `Don't save`
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form only if the user confirms
                    document.getElementById('edit-employee-form').submit();
                    Swal.fire("Saved!", "", "success");
                } else if (result.isDenied) {
                    Swal.fire("Changes are not saved", "", "info");
                }
            });
        });
    </script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initializing entite-departement-poste relationship
        const entiteSelect = document.getElementById('entite_id');
        const departementSelect = document.getElementById('departement_id');
        const posteSelect = document.getElementById('poste_id');

        if (entiteSelect && departementSelect && posteSelect) {
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

            departementSelect.addEventListener('change', function () {
                const departementId = this.value;
                fetch(`/departements/${departementId}/postes`)
                    .then(response => response.json())
                    .then(data => {
                        posteSelect.innerHTML = '';
                        data.forEach(postes => {
                            const option = document.createElement('option');
                            option.value = postes.id;
                            option.textContent = postes.titre;
                            posteSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error fetching postes', error));
            });

            // Trigger change event on page load if default value is selected
            if (entiteSelect.value) {
                entiteSelect.dispatchEvent(new Event('change'));
            }
        }

// Initializing country-state-city relationship
const config = {
cUrl: 'https://api.countrystatecity.in/v1',
ckey: 'NHhvOEcyWk50N2Vna3VFTE00bFp3MjFKR0ZEOUhkZlg4RTk1MlJlaA=='
};

const countrySelect = document.getElementById('pays');
const stateSelect = document.getElementById('state');
const citySelect = document.getElementById('ville');

if (countrySelect && stateSelect && citySelect) {
function loadCountries() {
    console.log('Loading countries...');
    let apiEndPoint = config.cUrl + '/countries';

    fetch(apiEndPoint, {
        headers: {
            "X-CSCAPI-KEY": config.ckey
        }
    })
        .then(response => response.json())
        .then(data => {
            console.log('Countries loaded:', data);
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
    console.log('Loading states for country:', countrySelect.value);
    stateSelect.disabled = false;
    citySelect.disabled = true;
    stateSelect.style.pointerEvents = 'auto';
    citySelect.style.pointerEvents = 'none';

    const selectedCountryCode = countrySelect.value;
    stateSelect.innerHTML = '<option value="">choisir État</option>'; // Clear existing states
    citySelect.innerHTML = '<option value="">choisir ville</option>'; // Clear existing city options

    fetch(`${config.cUrl}/countries/${selectedCountryCode}/states`, {
        headers: {
            "X-CSCAPI-KEY": config.ckey
        }
    })
        .then(response => response.json())
        .then(data => {
            console.log('States loaded:', data);
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
    console.log('Loading cities for state:', stateSelect.value);
    citySelect.disabled = false;
    citySelect.style.pointerEvents = 'auto';

    const selectedCountryCode = countrySelect.value;
    const selectedStateCode = stateSelect.value;
    citySelect.innerHTML = '<option value="">choisir ville</option>'; // Clear existing city options

    fetch(`${config.cUrl}/countries/${selectedCountryCode}/states/${selectedStateCode}/cities`, {
        headers: {
            "X-CSCAPI-KEY": config.ckey
        }
    })
        .then(response => response.json())
        .then(data => {
            console.log('Cities loaded:', data);
            data.forEach(city => {
                const option = document.createElement('option');
                option.value = city.name;
                option.textContent = city.name;
                citySelect.appendChild(option);
            });
        })
        .catch(error => console.error('Error loading cities:', error));
}

window.onload = function () {
    loadCountries();
};

countrySelect.addEventListener('change', loadStates);
stateSelect.addEventListener('change', loadCities);
}


        // Initialize intl-tel-input on phone-input field
        var input = document.querySelector(".phone-input input[type='tel']");
        if (input) {
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
        }

        // Handle "Autre" option in situation familiale
        const selectSituationFamiliale = document.getElementById('situation_familiale');
        const autreSituationFamilialeDiv = document.getElementById('autreSituationFamiliale');
        const autreSituationFamilialeInput = document.getElementById('autre_situation_familiale');

        if (selectSituationFamiliale && autreSituationFamilialeDiv && autreSituationFamilialeInput) {
            selectSituationFamiliale.addEventListener('change', function () {
                if (selectSituationFamiliale.value === 'Autre') {
                    autreSituationFamilialeDiv.style.display = 'block';
                    autreSituationFamilialeInput.setAttribute('required', 'required');
                } else {
                    autreSituationFamilialeDiv.style.display = 'none';
                    autreSituationFamilialeInput.removeAttribute('required');
                }
            });

            if (selectSituationFamiliale.value === 'Autre') {
                autreSituationFamilialeDiv.style.display = 'block';
                autreSituationFamilialeInput.setAttribute('required', 'required');
            }
        }
          });
</script>
     <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dateDelivranceInput = document.getElementById('passeport_date_delivrance');
            const dateExpirationInput = document.getElementById('passeport_date_expiration');
            const delaiValiditeInput = document.getElementById('passeport_delai_validite');

            function calculateValidity() {
                const dateDelivrance = new Date(dateDelivranceInput.value);
                const dateExpiration = new Date(dateExpirationInput.value);
                const timeDiff = dateExpiration.getTime() - dateDelivrance.getTime();
                const dayDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));
                delaiValiditeInput.value = isNaN(dayDiff) ? '' : dayDiff;
            }

            dateDelivranceInput.addEventListener('change', calculateValidity);
            dateExpirationInput.addEventListener('change', calculateValidity);
        });
    </script>
<script>
function getTodayDate() {
    var today = new Date();
    var day = ("0" + today.getDate()).slice(-2);
    var month = ("0" + (today.getMonth() + 1)).slice(-2);
    var year = today.getFullYear();
    return year + "-" + month + "-" + day;
}

// Calculate contract duration
function calculateContractDuration() {
    var debutContrat = new Date(document.getElementById('debut_contrat').value);
    var finContrat = new Date(document.getElementById('fin_contrat').value);
    if (debutContrat && finContrat && finContrat > debutContrat) {
        var years = finContrat.getFullYear() - debutContrat.getFullYear();
        var months = finContrat.getMonth() - debutContrat.getMonth();
        if (months < 0) {
            years--;
            months += 12;
        }
        document.getElementById('duree_contrat').value = years + ' ans, ' + months + ' mois';
    } else {
        document.getElementById('duree_contrat').value = '';
    }
}

function updateMinDateForFinContrat() {
    var debutContrat = document.getElementById('debut_contrat').value;
    document.getElementById('fin_contrat').setAttribute('min', debutContrat);
}

// Set the initial min date for debut_contrat
document.getElementById('debut_contrat').setAttribute('min', getTodayDate());

// Add event listeners
document.getElementById('debut_contrat').addEventListener('change', updateMinDateForFinContrat);
document.getElementById('fin_contrat').addEventListener('change', calculateContractDuration);
</script>

<!-- Include intl-tel-input CSS and JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>


@endsection



