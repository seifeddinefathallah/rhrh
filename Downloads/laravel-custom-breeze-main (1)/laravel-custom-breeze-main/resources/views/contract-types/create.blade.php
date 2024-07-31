@extends('layouts.app')

@section('content')

<div class="layout-container" style="width: 85%; position: relative; left: 16%;">
    <div class=" container-xxl flex-grow-1 container-p-y">  
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card">
                    <div class="card-header">
                        Create Contract Type
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('contract-types.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="name">Name</label>
                                <select id="name" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="name" autofocus>
                                    <option value="">Choisir name</option>
                                    <option value="Temporaire">Temporaire</option>
                                    <option value="Permanant">Permanant</option>
                                </select>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" rows="4">{{ old('description') }}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="country">Country</label>
                                <select id="country" class="form-control @error('country') is-invalid @enderror" name="country" required>
                                    <option value="">Select a country</option>
                                </select>
                                @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group" id="classification-field">
                                <label for="classification">Classification</label>
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

                            <div class="form-group">
                                <label for="probation_period">Probation Period (months)</label>
                                <input id="probation_period" type="number" class="form-control @error('probation_period') is-invalid @enderror" name="probation_period" list="probation_periods" value="{{ old('probation_period') }}" min="1" max="4" step="1">
                            
                                <datalist id="probation_periods">
                                    <option value="1">1 month</option>
                                    <option value="2">2 months</option>
                                    <option value="3">3 months</option>
                                    <option value="4">4 months</option>
                                    <option value="6">6 months</option>
                                </datalist>
                            
                                @error('probation_period')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            

                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="renouvellement" name="renouvellement" value="1" {{ old('renouvellement', '1') == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="renouvellement">Renouvellement</label>
                            </div>

                            <div class="form-group">
                                <label for="cdt_renouv">CDT Renouv (default: 2)</label>
                                <input id="cdt_renouv" type="number" class="form-control @error('cdt_renouv') is-invalid @enderror" name="cdt_renouv" value="{{ old('cdt_renouv', 2) }}">
                                @error('cdt_renouv')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var renouvellementCheckbox = document.getElementById('renouvellement');
            var cdtRenouvInput = document.getElementById('cdt_renouv');

            if (renouvellementCheckbox.checked) {
                decrementCdtRenouv();
            }

            renouvellementCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    decrementCdtRenouv();
                } else {
                    cdtRenouvInput.value = 2;
                }
            });

            function decrementCdtRenouv() {
                var currentValue = parseInt(cdtRenouvInput.value);
                if (!isNaN(currentValue) && currentValue > 0) {
                    cdtRenouvInput.value = currentValue - 1;
                }
            }
        });
    </script>
 <script>
    document.addEventListener('DOMContentLoaded', function() {
        var countrySelect = document.getElementById('country');
        var classificationField = document.getElementById('classification-field');
        var coefficientField = document.getElementById('coefficient-field');

        function loadCountries() {
            let apiEndPoint = 'https://restcountries.com/v3.1/all';

            fetch(apiEndPoint)
            .then(response => response.json())
            .then(data => {
                data.forEach(country => {
                    const option = document.createElement('option');
                    option.value = country.cca2; // Utiliser le code alpha-2 des pays
                    option.textContent = country.name.common;
                    countrySelect.appendChild(option);
                });
                toggleFields(); // Appel après le chargement des pays
            })
            .catch(error => console.error('Error loading countries:', error));
        }

        function toggleFields() {
            if (countrySelect.value === 'FR') { // Utiliser le code alpha-2 pour la France
                classificationField.style.display = 'block';
                coefficientField.style.display = 'block';
            } else {
                classificationField.style.display = 'none';
                coefficientField.style.display = 'none';
            }
        }

        countrySelect.addEventListener('change', toggleFields);

        // Appel initial pour vérifier l'état au chargement de la page
        loadCountries();
        toggleFields();
    });
</script>

@endsection
