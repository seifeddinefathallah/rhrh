@component('mail::message')
# Loan Request Status Updated

Dear {{ $loanRequest->employee->prenom }} {{ $loanRequest->employee->nom }},

Your loan request has been updated.

**Status:** {{ ucfirst($loanRequest->status) }}

@if ($loanRequest->status === 'approved')
    Congratulations! Your request has been approved.
@elseif ($loanRequest->status === 'rejected')
    We're sorry, but your request has been rejected.
@endif



Thank you for using our application!

Regards,<br>
{{ config('app.name') }}
@endcomponent
