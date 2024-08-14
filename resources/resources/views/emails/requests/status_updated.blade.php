@component('mail::message')
# Loan Request Status Updated

Dear {{ $request->employee->prenom }} {{ $request->employee->nom }},

Your loan request has been updated.

**Status:** {{ ucfirst($request->status) }}

@if ($request->status === 'approved')
    Congratulations! Your request has been approved.
@elseif ($request->status === 'rejected')
    We're sorry, but your request has been rejected.
@endif



Thank you for using our application!

Regards,<br>
{{ config('app.name') }}
@endcomponent

