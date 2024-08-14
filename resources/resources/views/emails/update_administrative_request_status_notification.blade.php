@component('mail::message')
# Mise à jour du statut de demande administrative

Bonjour {{ $employee->nom }} {{ $employee->prenom }},

Le statut de votre demande administrative de type "{{ $administrativeRequest->type }}" a été mis à jour à "{{ $administrativeRequest->status }}".


Merci,<br>
{{ config('app.name') }}
@endcomponent
