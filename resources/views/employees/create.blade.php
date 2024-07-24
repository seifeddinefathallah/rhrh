@extends('layouts.app')

@section('content')


<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="bg-green-200 border border-green-200 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Error message -->
            @if(session('error'))
                <div class="bg-red-200 border border-red-200 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <!-- SweetAlert2 Notification -->
            @push('scripts')
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        @if(session('success'))
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: "{{ session('success') }}",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        @elseif(session('error'))
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: "{{ session('error') }}",
                            footer: '<a href="#">Why do I have this issue?</a>'
                        });
                        @endif
                    });
                </script>
            @endpush

            <form method="POST" action="{{ route('employees.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="image">Image de l'employee</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                </div>
                <!-- Personal Information Section -->
                <div class="border mb-4 p-4">
                    <h3 class="text-lg font-semibold mb-2">Informations Personnelles</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom') }}" required>
                            @error('nom')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="prenom" class="form-label">Prénom</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" value="{{ old('prenom')}}" required>
                            @error('prenom')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="date_naissance" class="form-label">Date de Naissance</label>
                            <input type="date" class="form-control" id="date_naissance" name="date_naissance" value="{{ old('date_naissance') }}" required>
                            @error('date_naissance')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email_personnel" class="form-label">Email Personnel</label>
                            <input type="email" class="form-control" id="email_personnel" name="email_personnel" value="{{ old('email_personnel') }}">
                            @error('email_personnel')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3 phone-input">
                            <label for="telephone" class="form-label">Téléphone</label>
                            <input type="tel" class="form-control" id="telephone" name="telephone" value="{{ old('telephone') }}" required>
                            @error('telephone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="situation_familiale" class="form-label">Situation Familiale</label>
                            <select class="form-control" id="situation_familiale" name="situation_familiale" required>
                                <option value="">Choisir la situation familiale</option>
                                <option value="Célibataire" {{ old('situation_familiale') == 'Célibataire' ? 'selected' : '' }}>Célibataire</option>
                                <option value="Marié(e)" {{ old('situation_familiale') == 'Marié(e)' ? 'selected' : '' }}>Marié(e)</option>
                                <option value="Divorcé(e)" {{ old('situation_familiale') == 'Divorcé(e)' ? 'selected' : '' }}>Divorcé(e)</option>
                                <option value="Veuf/Veuve" {{ old('situation_familiale') == 'Veuf/Veuve' ? 'selected' : '' }}>Veuf/Veuve</option>

                            </select>

                        </div>



                        <div class="mb-3">
                            <label for="nombre_enfants" class="form-label">Nombre d'Enfants</label>
                            <input type="number" class="form-control" id="nombre_enfants" name="nombre_enfants" value="{{ old('nombre_enfants') }}" required>
                            @error('nombre_enfants')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                </div>

                <!-- Professional Information Section -->
                <div class="border mb-4 p-4">
                    <h3 class="text-lg font-semibold mb-2">Informations Professionnelles</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-3">
                            <label for="email_professionnel" class="form-label">Email Professionnel</label>
                            <input type="email" class="form-control" id="email_professionnel" name="email_professionnel" value="{{ old('email_professionnel') }}" required>
                            @error('email_professionnel')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="matricule" class="form-label">Matricule</label>
                            <input type="text" class="form-control" id="matricule" name="matricule" value="{{ old('matricule') }}" required>
                            @error('matricule')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="entite_id" class="form-label">Entité</label>
                            <select class="form-control" id="entite_id" name="entite_id" required>
                                <option value="">Select Entity</option>
                                @foreach($entites as $entite)
                                <option value="{{ $entite->id }}" {{ old('entite_id') == $entite->id ? 'selected' : '' }}>{{ $entite->nom }}</option>
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
                            <input type="text" class="form-control" id="code_postal" name="code_postal" value="{{ old('code_postal') }}">
                        </div>

                        <div class="mb-3">
                            <label for="adresse" class="form-label">Adresse</label>
                            <input type="text" class="form-control" id="adresse" name="adresse" value="{{ old('adresse') }}" required>
                        </div>
                    </div>
                </div>

                <!-- Identity Documents Section -->
                <div class="border mb-4 p-4">
                    <h3 class="text-lg font-semibold mb-2">Documents d'Identité</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-3">
                            <label for="cin_numero" class="form-label">Numéro de CIN</label>
                            <input type="text" class="form-control" id="cin_numero" name="cin_numero" value="{{ old('cin_numero') }}">
                            @error('cin_numero')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="cin_date_delivrance" class="form-label">Date de Délivrance de CIN</label>
                            <input type="date" class="form-control" id="cin_date_delivrance" name="cin_date_delivrance" value="{{ old('cin_date_delivrance') }}">
                            @error('cin_date_delivrance')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Contact Section -->
                <div class="border mb-4 p-4">
                    <h3 class="text-lg font-semibold mb-2">Passeport</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label for="passeport_numero" class="form-label">Passeport Numéro</label>
                            <input type="text" name="passeport_numero" id="passeport_numero" class="form-control" value="{{ old('passeport_numero') }}">
                            @error('passeport_numero')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="passeport_date_delivrance" class="form-label">Passeport Date Délivrance</label>
                            <input type="date" name="passeport_date_delivrance" id="passeport_date_delivrance" class="form-control" value="{{ old('passeport_date_delivrance') }}">
                            @error('passeport_date_delivrance')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="passeport_date_expiration" class="form-label">Passeport Date Expiration</label>
                            <input type="date" name="passeport_date_expiration" id="passeport_date_expiration" class="form-control" value="{{ old('passeport_date_expiration') }}">
                            @error('passeport_date_expiration')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="passeport_delai_validite" class="form-label">Passport Délai de Validité</label>
                            <input type="text" id="passeport_delai_validite" name="passeport_delai_validite" class="form-control" value="{{ old('passeport_delai_validite') }}" readonly>
                            @error('passeport_delai_validite')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>
                </div>

                <!-- Contact Section -->
                <div class="border mb-4 p-4">
                    <h3 class="text-lg font-semibold mb-2">Carte de Séjour</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label for="carte_sejour_numero" class="form-label">Carte de Séjour Numéro</label>
                            <input type="text" name="carte_sejour_numero" id="carte_sejour_numero" class="form-control" value="{{ old('carte_sejour_numero') }}">
                            @error('carte_sejour_numero')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="carte_sejour_date_delivrance" class="form-label">Carte de Séjour Date Délivrance</label>
                            <input type="date" name="carte_sejour_date_delivrance" id="carte_sejour_date_delivrance" class="form-control" value="{{ old('carte_sejour_date_delivrance') }}">
                            @error('carte_sejour_date_delivrance')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="carte_sejour_date_expiration" class="form-label">Carte de Séjour Date Expiration</label>
                            <input type="date" name="carte_sejour_date_expiration" id="carte_sejour_date_expiration" class="form-control" value="{{ old('carte_sejour_date_expiration') }}">
                            @error('carte_sejour_date_expiration')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="carte_sejour_type" class="form-label">Carte de Séjour Type</label>
                            <input type="text" name="carte_sejour_type" id="carte_sejour_type" class="form-control" value="{{ old('carte_sejour_type') }}">
                            @error('carte_sejour_type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Créer Employé</button>
                </div>
                <div class="mt-4">
                    <a href="{{ route('employees.index') }}" class="btn btn-primary">Retour à la liste</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const entiteSelect = document.getElementById('entite_id');
        const departementSelect = document.getElementById('departement_id');
        const posteSelect = document.getElementById('poste_id');

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
    document.addEventListener('DOMContentLoaded', function () {
        const dateDelivranceInput = document.getElementById('passeport_date_delivrance');
        const dateExpirationInput = document.getElementById('passeport_date_expiration');
        const delaiValiditeInput = document.getElementById('passeport_delai_validite');

        function calculateValidity() {
            const dateDelivrance = new Date(dateDelivranceInput.value);
            const dateExpiration = new Date(dateExpirationInput.value);

            // Calculate years
            let yearsDiff = dateExpiration.getFullYear() - dateDelivrance.getFullYear();
            let monthsDiff = dateExpiration.getMonth() - dateDelivrance.getMonth();
            let daysDiff = dateExpiration.getDate() - dateDelivrance.getDate();

            if (daysDiff < 0) {
                monthsDiff--;
                const lastMonth = new Date(dateExpiration.getFullYear(), dateExpiration.getMonth() - 1, dateDelivrance.getDate());
                daysDiff = Math.floor((dateExpiration - lastMonth) / (1000 * 3600 * 24));
            }

            if (monthsDiff < 0) {
                yearsDiff--;
                monthsDiff += 12;
            }

            delaiValiditeInput.value = `${yearsDiff} year(s) ${monthsDiff} month(s) ${daysDiff} day(s)`;
        }

        dateDelivranceInput.addEventListener('change', calculateValidity);
        dateExpirationInput.addEventListener('change', calculateValidity);
    });
</script>


@endsection

