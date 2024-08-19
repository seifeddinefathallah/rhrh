@component('mail::message')
    # New Material Request Created

    Hello {{ $materialRequest->employee->prenom }} {{ $materialRequest->employee->nom }},

    Your material request for "{{ $materialRequest->material_name }}" has been created successfully. Here are the details:

    - **Description:** {{ $materialRequest->description }}
    - **Quantity:** {{ $materialRequest->quantity }}

    Thank you,
    {{ config('app.name') }}
@endcomponent
