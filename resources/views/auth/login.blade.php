@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}" id="login-form">
                        @csrf

                        <!-- Email or Username -->
                        <div class="form-group">
                            <x-input-label for="input_type" :value="__('Email/Username')" />
                            <x-text-input id="input_type" class="form-control {{ session('input_type_status') }}" type="text" name="input_type" :value="old('input_type')" autofocus />
                            @if(session('input_type_status'))
                            <x-input-error :messages="session('input_type_errors')" class="mt-2" />
                            @endif
                        </div>

                        <!-- Password -->
                        <div class="form-group mt-4">
                            <x-input-label for="password" :value="__('Password')" />
                            <x-text-input id="password" class="form-control {{ session('password_status') }}" type="password" name="password" autocomplete="current-password" />
                            @if(session('password_status'))
                            <x-input-error :messages="session('password_errors')" class="mt-2" />
                            @endif
                        </div>
                        <input type="hidden" id="onesignal_player_id" name="onesignal_player_id">

                        <!-- Remember Me -->
                        <div class="form-group form-check mt-4">
                            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                            <label for="remember_me" class="form-check-label">{{ __('Remember me') }}</label>
                        </div>

                        <div class="form-group mb-3">
                            {!! NoCaptcha::renderJs() !!}
                            {!! NoCaptcha::display() !!}
                            @if(session('captcha_status'))
                            <x-input-error :messages="session('captcha_errors')" class="mt-2" />
                            @endif
                        </div>

                        <div class="form-group mt-4">
                            @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                            @endif

                            <button type="submit" class="btn btn-primary">
                                {{ __('Log in') }}
                            </button>
                        </div>
                    </form>

                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script src="https://cdn.onesignal.com/sdks/web/v16/OneSignalSDK.js" async></script>
                    <script>
                        window.OneSignal = window.OneSignal || [];
                        OneSignal.push(function() {
                            OneSignal.init({
                                appId: "f815d9fe-2803-44f4-886d-0ede2d40ba52",
                            });

                            const form = document.getElementById('login-form');
                            form.onsubmit = function(event) {
                                event.preventDefault(); // Prevent the form from submitting immediately

                                OneSignal.getUserId().then(function(userId) {
                                    console.log("OneSignal User ID:", userId);

                                    // Send push notification via OneSignal's REST API
                                    fetch('https://onesignal.com/api/v1/notifications', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'Authorization': 'Basic N2M4Njg5MjgtNGQxMi00NmQyLWJjNDUtNDU0MDNlODU4ZmMw' // Replace with your OneSignal REST API key
                                        },
                                        body: JSON.stringify({
                                            app_id: "f815d9fe-2803-44f4-886d-0ede2d40ba52", // Your OneSignal App ID
                                            include_player_ids: [userId], // Send notification to this user
                                            contents: { en: "Welcome back! You have logged in successfully." }, // Notification content
                                            headings: { en: "Login Notification" }, // Notification title
                                            url: "https://127.0.0.1:8000/dashboard" // URL to open when notification is clicked
                                        })
                                    }).then(response => {
                                        console.log('Notification sent:', response);
                                        // Optionally, redirect user after successful login
                                        window.location.href = "{{ route('dashboard') }}";
                                    }).catch(error => {
                                        console.error('Error sending notification:', error);
                                    });
                                });
                            };
                        });

                        @if (session('login_success'))
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Login successful!',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        @endif
                    </script>
                    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
