
@component('mail::message')
#  Demande administrative approuvée

Bonjour {{ $employee->nom }} {{ $employee->prenom }},

Votre demande administrative de type "{{ $request->type }}"  a été approuvée.

Merci,<br>
{{ config('app.name') }}
@endcomponent
