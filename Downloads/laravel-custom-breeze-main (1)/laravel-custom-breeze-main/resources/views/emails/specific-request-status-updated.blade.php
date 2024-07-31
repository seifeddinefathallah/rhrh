@component('mail::message')
    # Mise à Jour du Statut de Demande Spécifique

    Bonjour {{ $specificRequest->employee->prenom }} {{ $specificRequest->employee->nom }},

    Le statut de votre demande spécifique de type "{{ $specificRequest->request_type }}" a été mis à jour à "{{ $specificRequest->status }}".

    Merci,
    {{ config('app.name') }}
@endcomponent
