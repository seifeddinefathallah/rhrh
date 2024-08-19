@component('mail::message')
    # Nouvelle Demande Spécifique Créée

    Bonjour {{ $specificRequest->employee->prenom }} {{ $specificRequest->employee->nom }},

    Votre demande spécifique de type "{{ $specificRequest->request_type }}" a été créée avec succès. Voici les détails :

    - **Description :** {{ $specificRequest->description }}

    Merci,
    {{ config('app.name') }}
@endcomponent
