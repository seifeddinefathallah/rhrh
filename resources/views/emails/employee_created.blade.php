@component('mail::message')
# Welcome to Csi

Hello {{ $employee->prenom }} {{ $employee->nom }},

Welcome to Csi! We are excited to have you on board.
**Username:** {{ $employee->user->username }}
**Email:** {{ $employee->email_professionnel }}
Your default password is: **{{ $password }}**

You will be working in the following department:
- **Entity(ies):**
@foreach ($employee->departement->entites as $entite)
{{ $entite->nom }}{{ !$loop->last ? ',' : '' }}
@endforeach
- **Department:** {{ $employee->departement->nom }}
- **Position:** {{ $employee->poste->titre }}

Please log in and change your password as soon as possible.

Best regards,
Csi
@endcomponent
