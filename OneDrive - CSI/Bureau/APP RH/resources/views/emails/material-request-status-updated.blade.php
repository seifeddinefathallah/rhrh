@component('mail::message')
    # Material Request Status Updated

    Hello {{ $materialRequest->employee->prenom }} {{ $materialRequest->employee->nom }},

    The status of your material request for "{{ $materialRequest->material_name }}" has been updated to "{{ $materialRequest->status }}".

    Thank you,
    {{ config('app.name') }}
@endcomponent
