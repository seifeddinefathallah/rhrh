<?php

// app/Http/Controllers/OneSignalController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PushSubscription;

class OneSignalController extends Controller
{
    public function saveUserId(Request $request)
    {
        $request->validate([
            'userId' => 'required|string',
        ]);

        // Get the authenticated user or use any logic to determine the user
        $user = Auth::user();

        if ($user) {
            // Save the OneSignal user ID to the database
            $user->onesignal_user_id = $request->input('userId');
            $user->save();

            return response()->json(['message' => 'User ID saved successfully']);
        }

        return response()->json(['message' => 'User not authenticated'], 403);
    }
    public function savePushSubscriptionId(Request $request)
    {
        \Log::info('Saving push subscription ID', ['request' => $request->all()]);

        try {
            $userId = Auth::id();
            $pushSubscriptionId = $request->input('pushSubscriptionId');

            if (!$userId) {
                \Log::error('User not authenticated');
                return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
            }

            \Log::info('User ID', ['user_id' => $userId]);
            \Log::info('Push Subscription ID', ['subscription_id' => $pushSubscriptionId]);

            PushSubscription::updateOrCreate(
                ['user_id' => $userId, 'subscription_id' => $pushSubscriptionId],
                ['subscription_id' => $pushSubscriptionId]
            );

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            \Log::error('Error saving push subscription ID: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }
}

