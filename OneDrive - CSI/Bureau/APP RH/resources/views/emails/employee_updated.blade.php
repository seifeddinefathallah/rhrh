@component('mail::message')
# Mise à jour du profil employé

Bonjour {{ $employee->nom }} {{ $employee->prenom }},

Votre profil a été mis à jour avec les détails suivants :

@component('mail::table')
| Champ                     | Détail                       |
|---------------------------|------------------------------|
| **Nom**                   | {{ $employee->nom }}         |
| **Prénom**                | {{ $employee->prenom }}      |
| **Date de naissance**     | {{ $employee->date_naissance }} |
| **Email professionnel**   | {{ $employee->email_professionnel }} |
| **Email personnel**       | {{ $employee->email_personnel ?? 'N/A' }} |
| **Matricule**             | {{ $employee->matricule }}   |
| **Téléphone**             | {{ $employee->telephone }}   |
| **Code postal**           | {{ $employee->code_postal }} |
| **Ville**                 | {{ $employee->ville }}       |
| **Pays**                  | {{ $employee->pays }}        |
| **État/Province**         | {{ $employee->state ?? 'N/A' }} |
| **Adresse**               | {{ $employee->adresse }}     |
| **Situation familiale**   | {{ $employee->situation_familiale }} |
| **Nombre d'enfants**      | {{ $employee->nombre_enfants }} |
@endcomponent

@if($employee->cin_numero)
@component('mail::panel')
### Carte d'identité nationale (CIN)
- **Numéro CIN** : {{ $employee->cin_numero }}
- **Date de délivrance** : {{ $employee->cin_date_delivrance ?? 'N/A' }}
@endcomponent
@endif

@if($employee->carte_sejour_numero)
@component('mail::panel')
### Carte de séjour
- **Numéro de carte de séjour** : {{ $employee->carte_sejour_numero }}
- **Date de délivrance** : {{ $employee->carte_sejour_date_delivrance ?? 'N/A' }}
- **Date d'expiration** : {{ $employee->carte_sejour_date_expiration ?? 'N/A' }}
- **Type de carte de séjour** : {{ $employee->carte_sejour_type ?? 'N/A' }}
@endcomponent
@endif

@if($employee->passeport_numero)
@component('mail::panel')
### Passeport
- **Numéro de passeport** : {{ $employee->passeport_numero }}
- **Date de délivrance** : {{ $employee->passeport_date_delivrance ?? 'N/A' }}
- **Date d'expiration** : {{ $employee->passeport_date_expiration ?? 'N/A' }}
- **Délai de validité** : {{ $employee->passeport_delai_validite ?? 'N/A' }}
@endcomponent
@endif

Merci,<br>
{{ config('app.name') }}
@endcomponent
