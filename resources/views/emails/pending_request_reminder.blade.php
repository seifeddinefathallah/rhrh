@component('mail::message')
    # Pending Request Reminder

    Hello {{ $request->employee->prenom }} {{ $request->employee->nom }},

    This is a reminder that you have a pending {{ $type }} request. Please check your dashboard for more details.

    **Request Type:** {{ $type }}

    @component('mail::button', ['url' => url('/dashboard')])
        View Dashboard
    @endcomponent

    Thank you,

    {{ config('app.name') }}
@endcomponent
