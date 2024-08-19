@component('mail::message')
    # Upcoming Leave Reminder

    Hello {{ $leaveRequest->employee->prenom }} {{ $leaveRequest->employee->nom }},

    This is a reminder that you have an upcoming leave request starting on **{{ \Carbon\Carbon::parse($leaveRequest->start_date)->format('d/m/Y') }}** and ending on **{{ \Carbon\Carbon::parse($leaveRequest->end_date)->format('d/m/Y') }}**.

    Please ensure all necessary preparations are completed before your leave begins.

    Thank you,
    {{ config('app.name') }}
@endcomponent
