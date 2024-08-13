@component('mail::message')
    # Leave Request Submitted

    Hello {{ $leaveRequest->employee->prenom }} {{ $leaveRequest->employee->nom }},

    Your leave request has been successfully submitted. Here are the details:

    - **Leave Type:** {{ $leaveRequest->leaveType->name }}
    - **Start Date:** {{ \Carbon\Carbon::parse($leaveRequest->start_date)->format('d/m/Y') }}
    - **End Date:** {{ \Carbon\Carbon::parse($leaveRequest->end_date)->format('d/m/Y') }}
    - **Reason:** {{ $leaveRequest->reason ?? 'No reason provided' }}

    @if($leaveRequest->leaveType->requires_medical_certificate)
        Please remember to upload your medical certificate before {{ \Carbon\Carbon::parse($leaveRequest->certificate_upload_deadline)->format('d/m/Y H:i') }}.
    @endif

    Thank you,
    {{ config('app.name') }}
@endcomponent
