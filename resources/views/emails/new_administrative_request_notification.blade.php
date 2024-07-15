@component('mail::message')
# Nouvelle demande administrative

Bonjour {{ $user->employee->nom }} {{ $user->employee->prenom }},

Une nouvelle demande administrative de type "{{ $administrativeRequest->type }}" a été créée.

Merci,<br>
{{ config('app.name') }}
@endcomponent
