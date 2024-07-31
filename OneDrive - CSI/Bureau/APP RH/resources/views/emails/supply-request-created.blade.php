@component('mail::message')
    # New Supply Request Created

    Hello {{ $supplyRequest->employee->prenom }} {{ $supplyRequest->employee->nom }},

    Your supply request for "{{ $supplyRequest->item_name }}" has been created successfully. Here are the details:

    - **Quantity:** {{ $supplyRequest->quantity }}

    Thank you,
    {{ config('app.name') }}
@endcomponent
