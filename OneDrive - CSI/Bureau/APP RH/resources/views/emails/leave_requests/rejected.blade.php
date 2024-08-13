@component('mail::message')
    # Leave Request Rejected

    Hello {{ $leaveRequest->employee->user->name }},

    We regret to inform you that your leave request has been rejected. Here are the details:

    - **Leave Type:** {{ $leaveRequest->leaveType->name }}
    - **Start Date:** {{ \Carbon\Carbon::parse($leaveRequest->start_date)->format('d/m/Y') }}
    - **End Date:** {{ \Carbon\Carbon::parse($leaveRequest->end_date)->format('d/m/Y') }}
    - **Reason:** {{ $leaveRequest->reason ?? 'No reason provided' }}

    Please contact your manager for further details.

    Thank you,
    {{ config('app.name') }}
@endcomponent
