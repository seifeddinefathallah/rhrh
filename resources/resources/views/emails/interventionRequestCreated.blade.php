@component('mail::message')
    # New Intervention Request Created

    Hello {{ $interventionRequest->employee->prenom }} {{ $interventionRequest->employee->nom }},

    Your intervention request has been created successfully. Here are the details:

    - Description: {{ $interventionRequest->description }}
    - Date: {{ \Carbon\Carbon::parse($interventionRequest->request_date)->format('d/m/Y') }}

    Thank you,
    {{ config('app.name') }}
@endcomponent
