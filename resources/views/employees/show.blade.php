<!-- resources/views/employees/show.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employee Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Informations de l'Employé {{ $employee->nom }} {{ $employee->prenom }}</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Section principale avec l'image -->
                        <div>
                            <div class="mb-3">
                                <h4 class="mb-2 font-semibold">Photo</h4>
                                @if ($employee->image)
                                <img src="{{ asset('storage/' . $employee->image) }}" alt="Image de l'employé {{ $employee->prenom }} {{ $employee->nom }}" class="img-fluid">
                                @else
                                <p>Aucune image disponible</p>
                                @endif
                            </div>

                            <h4 class="mb-2 font-semibold">Détails Personnels</h4>
                            <div class="border rounded p-4 mb-4">
                                <div class="mb-3">
                                    <label class="form-label"><strong>Nom:</strong></label>
                                    <p>{{ $employee->nom }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Prénom:</strong></label>
                                    <p>{{ $employee->prenom }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Date de Naissance:</strong></label>
                                    <p>{{ $employee->date_naissance }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Email Personnel:</strong></label>
                                    <p>{{ $employee->email_personnel }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Téléphone:</strong></label>
                                    <p>{{ $employee->telephone }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Situation Familiale:</strong></label>
                                    <p>{{ $employee->situation_familiale }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Nombre d'Enfants:</strong></label>
                                    <p>{{ $employee->nombre_enfants }}</p>
                                </div>
                            </div>
                            <h4 class="mb-2 font-semibold">Informations Professionnelles</h4>
                            <div class="border rounded p-4 mb-4">
                                <div class="mb-3">
                                    <label class="form-label"><strong>Email Professionnel:</strong></label>
                                    <p>{{ $employee->email_professionnel }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Matricule:</strong></label>
                                    <p>{{ $employee->matricule }}</p>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label"><strong>Département:</strong></label>
                                    <p>{{ $employee->departement->nom }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Poste:</strong></label>
                                    <p>{{ $employee->poste->titre }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Solde Autorisation Sortie:</strong></label>
                                    <p>{{ $employee->sortie_balance }}heures</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Solde Autorisation Télétravail:</strong></label>
                                    <p>{{ $employee->teletravail_days_balance }} jours</p>
                                </div>
                            </div>



                        </div>

                        <!-- Section CIN, Passport, Carte de Séjour -->
                        <div>
                            <h4 class="mb-2 font-semibold">Carte d'Identité Nationale (CIN)</h4>
                            <div class="border rounded p-4 mb-4">
                                <div class="mb-3">
                                    <label class="form-label"><strong>Numéro CIN:</strong></label>
                                    <p>{{ $employee->cin_numero ?? 'N/A' }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Date de délivrance CIN:</strong></label>
                                    <p>{{ $employee->cin_date_delivrance }}</p>
                                </div>
                            </div>

                            <h4 class="mb-2 font-semibold">Passeport</h4>
                            <div class="border rounded p-4 mb-4">
                                <div class="mb-3">
                                    <label class="form-label"><strong>Numéro de Passeport:</strong></label>
                                    <p>{{ $employee->passeport_numero }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Date de délivrance Passeport:</strong></label>
                                    <p>{{ $employee->passeport_date_delivrance }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Date d'expiration Passeport:</strong></label>
                                    <p>{{ $employee->passeport_date_expiration }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Délai de validité Passeport:</strong></label>
                                    <p>{{ $employee->passeport_delai_validite }}</p>
                                </div>
                            </div>

                            <h4 class="mb-2 font-semibold">Carte de Séjour</h4>
                            <div class="border rounded p-4 mb-4">
                                <div class="mb-3">
                                    <label class="form-label"><strong>Numéro Carte de Séjour:</strong></label>
                                    <p>{{ $employee->carte_sejour_numero }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Date de délivrance Carte de Séjour:</strong></label>
                                    <p>{{ $employee->carte_sejour_date_delivrance }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Date d'expiration Carte de Séjour:</strong></label>
                                    <p>{{ $employee->carte_sejour_date_expiration }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Type Carte de Séjour:</strong></label>
                                    <p>{{ $employee->carte_sejour_type }}</p>
                                </div>
                            </div>

                            <!-- Section Domiciliation -->
                            <h4 class="mb-2 font-semibold">Domiciliation</h4>
                            <div class="border rounded p-4 mb-4">
                                <div class="mb-3">
                                    <label class="form-label"><strong>Pays:</strong></label>
                                    <p>{{ $employee->pays }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Ville:</strong></label>
                                    <p>{{ $employee->ville }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>État/Province:</strong></label>
                                    <p>{{ $employee->state }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Adresse:</strong></label>
                                    <p>{{ $employee->adresse }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Code Postal:</strong></label>
                                    <p>{{ $employee->code_postal }}</p>
                                </div>
                            </div>

                            <!-- Section Professionnelle -->

                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('employees.index') }}" class="btn btn-primary">Retour à la liste</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
