<?php

namespace App\Console\Commands;

use App\Models\AuthorizationRequest;
use App\Models\InterventionRequest;
use App\Models\LoanRequest;
use App\Models\MaterialRequest;
use App\Models\SpecificRequest;
use App\Models\SupplyRequest;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\LeaveRequest;
use App\Models\AdministrativeRequest;
use App\Mail\PendingRequestReminderMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use OneSignal;

class SendPendingRequestReminders extends Command
{
    protected $signature = 'reminders:send-pending-requests';
    protected $description = 'Send reminders for all pending requests across multiple tables';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('Sending reminders for pending requests...');

        // Retrieve and handle pending requests with eager loading
        $this->sendPendingReminders(LeaveRequest::class, 'pending', 'leave');
        $this->sendPendingReminders(AdministrativeRequest::class, 'En attente', 'administrative');
        $this->sendPendingReminders(AuthorizationRequest::class, 'pending', 'diverse');
        $this->sendPendingReminders(MaterialRequest::class, 'pending', 'material');
        $this->sendPendingReminders(SpecificRequest::class, 'pending', 'specific');
        $this->sendPendingReminders(SupplyRequest::class, 'pending', 'supply');
        $this->sendPendingReminders(InterventionRequest::class, 'pending', 'intervention');
        $this->sendPendingReminders(LoanRequest::class, 'En attente', 'loan');

        $this->info('Reminders sent successfully.');
    }

    private function sendPendingReminders($modelClass, $status, $type)
    {
        $requests = $modelClass::with('employee')->where('status', $status)->get();

        foreach ($requests as $request) {
            if ($request->employee) { // Check if employee is not null
                // Send email
                Mail::to($request->employee->email_professionnel)
                    ->send(new PendingRequestReminderMail($request, $type));

                // Send OneSignal notification
                $employeeSubscriptions = DB::table('push_subscriptions')
                    ->where('user_id', $request->employee->user_id)
                    ->pluck('subscription_id')
                    ->toArray();

                $notificationMessage = "You have a pending $type request. Please check your dashboard for more details.";
                $this->sendOneSignalNotification($notificationMessage, $employeeSubscriptions, $type);

                $this->info("Sent reminder for $type request ID: " . $request->id);
            } else {
                $this->info("No employee found for request ID: " . $request->id);
            }
        }
    }

    private function sendOneSignalNotification($message, $subscriptionIds, $action)
    {
        if (empty($subscriptionIds)) {
            return;
        }

        $notification = [
            'contents' => ['en' => $message],
            'include_player_ids' => $subscriptionIds,
            'data' => ['action' => $action],
        ];

        try {
            OneSignal::sendNotificationCustom($notification);
        } catch (\Exception $e) {
            Log::error('Error sending OneSignal notification: ' . $e->getMessage());
        }
    }
}
