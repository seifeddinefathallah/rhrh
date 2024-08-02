@component('mail::message')
# Nouvelle demande administrative

Bonjour {{ $employee->nom }} {{ $employee->prenom }},

Une nouvelle demande administrative de type "{{ $request->type }}" a été créée.

Merci,<br>
{{ config('app.name') }}
@endcomponent
