<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        //$this->authenticated($request, Auth::user());
        $this->postLoginActions($request);
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    protected function postLoginActions(Request $request)
    {
        // Flash a session variable for SweetAlert2
        Session::flash('login_success', true);

        // Handle OneSignal notification
        $user = Auth::user();
        $onesignalPlayerId = $user->onesignal_player_id;

        if ($onesignalPlayerId) {
            $this->sendOneSignalNotification($onesignalPlayerId);
        }
    }
    protected function sendOneSignalNotification($playerId)
    {
        $onesignalAppId = config('services.onesignal.app_id');
        $onesignalApiKey = config('services.onesignal.api_key');

        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . $onesignalApiKey,
            'Content-Type' => 'application/json',
        ])->post("https://onesignal.com/api/v1/notifications", [
            'app_id' => $onesignalAppId,
            'include_player_ids' => [$playerId],
            'data' => [
                'foo' => 'bar', // Add custom data if needed
            ],
            'contents' => [
                'en' => 'Welcome back! You have successfully logged in.', // Notification message
            ],
        ]);

        // Log the OneSignal push notification response for debugging
        Log::info('OneSignal push notification response: ' . $response->body());
    }
}
