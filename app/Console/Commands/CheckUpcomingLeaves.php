<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\LeaveRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\LeaveReminderMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Berkayk\OneSignal\OneSignalFacade as OneSignal;


class CheckUpcomingLeaves extends Command
{
    protected $signature = 'check:upcoming-leaves';
    protected $description = 'Check for upcoming leave requests and send reminders';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('Checking upcoming leaves...');

        $today = now()->startOfDay();
        $oneWeekFromNow = $today->copy()->addDays(7);

        $upcomingLeaves = LeaveRequest::whereBetween('start_date', [$today, $oneWeekFromNow])
            ->get();

        $this->info('Upcoming leaves count: ' . $upcomingLeaves->count());

        foreach ($upcomingLeaves as $leaveRequest) {
            // Send email reminder
            Mail::to($leaveRequest->employee->email_professionnel)
                ->send(new LeaveReminderMail($leaveRequest));
            $this->info('Sent reminder email for leave request ID: ' . $leaveRequest->id);

            // Fetch OneSignal subscription IDs
            $employeeSubscriptions = DB::table('push_subscriptions')
                ->where('user_id', $leaveRequest->employee->user_id)
                ->pluck('subscription_id')
                ->toArray();

            // Prepare the notification message
            $notificationMessage = "Reminder: Your leave request starting on {$leaveRequest->start_date->format('d/m/Y')} and ending on {$leaveRequest->end_date->format('d/m/Y')} is approaching.";

            // Send OneSignal notification
            $this->sendOneSignalNotification_($notificationMessage, $employeeSubscriptions, 'leave_reminder');
            $this->info('Sent OneSignal reminder for leave request ID: ' . $leaveRequest->id);
        }
    }

    private function sendOneSignalNotification_($message, $subscriptionIds, $action)
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
