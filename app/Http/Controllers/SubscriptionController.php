<?php
// app/Http/Controllers/SubscriptionController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription; // Ensure you have this model

class SubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'subscriptionId' => 'required|string',
        ]);

        // Save the subscription ID to the database
        $subscriptionId = $request->input('subscriptionId');

        // Assuming you have a Subscription model
        Subscription::updateOrCreate(
            ['user_id' => auth()->id()], // Adjust according to your needs
            ['subscription_id' => $subscriptionId]
        );

        return response()->json(['message' => 'Subscription ID saved successfully']);
    }
}
