@component('mail::message')
    # Supply Request Status Updated

    Hello {{ $supplyRequest->employee->prenom }} {{ $supplyRequest->employee->nom }},

    The status of your supply request for "{{ $supplyRequest->item_name }}" has been updated to "{{ $supplyRequest->status }}".

    Thank you,
    {{ config('app.name') }}
@endcomponent
