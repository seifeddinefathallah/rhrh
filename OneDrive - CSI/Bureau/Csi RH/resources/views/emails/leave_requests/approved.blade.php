@component('mail::message')
    # Leave Request Approved

    Hello {{ $leaveRequest->employee->user->name }},

    Your leave request has been approved. Here are the details:

    - **Leave Type:** {{ $leaveRequest->leaveType->name }}
    - **Start Date:** {{ \Carbon\Carbon::parse($leaveRequest->start_date)->format('d/m/Y') }}
    - **End Date:** {{ \Carbon\Carbon::parse($leaveRequest->end_date)->format('d/m/Y') }}
    - **Reason:** {{ $leaveRequest->reason ?? 'No reason provided' }}

    Thank you,<br>
    {{ config('app.name') }}
@endcomponent
