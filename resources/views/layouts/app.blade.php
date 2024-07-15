<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CSI') }}</title>
    @notifyCss
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        window.OneSignal = window.OneSignal || [];
        OneSignal.push(function() {
            OneSignal.init({
                appId: "f815d9fe-2803-44f4-886d-0ede2d40ba52",
                notifyButton: {
                    enable: true,
                },
                welcomeNotification: {
                    title: "Bienvenue !",
                    message: "Merci de vous être abonné aux notifications."
                },
                promptOptions: {
                    native: {
                        enabled: true,  // Enable native prompt
                        autoPrompt: true,  // Automatically show prompt
                        pageViews: 1,
                        timeDelay: 0
                    },
                    slidedown: {
                        enabled: true,  // Ensure this is enabled if you want the slidedown prompt
                        prompts: [
                            {
                                icon: "",
                                text: {
                                    acceptButton: "Subscribe",
                                    cancelButton: "Later",
                                    actionMessage: "Subscribe to our notifications for the latest news and updates. You can disable anytime.",
                                    confirmMessage: "Thank You!",
                                    customizationEnabled: false,
                                    emailLabel: "Email Address",
                                    smsLabel: "Phone Number",
                                    negativeUpdateButton: "Cancel",
                                    positiveUpdateButton: "Save Preferences",
                                    updateMessage: "Update your push notification subscription preferences."
                                },
                                type: "push",
                                delay: {
                                    pageViews: 1,
                                    timeDelay: 10
                                },
                                enabled: true,
                                autoPrompt: true
                            }
                        ]
                    }
                }
            });

            // Check if push notifications are enabled
            OneSignal.isPushNotificationsEnabled(function(isEnabled) {
                if (isEnabled) {
                    console.log("Push notifications are enabled!");
                    OneSignal.getUserId(function(userId) {
                        if (userId) {
                            console.log("OneSignal User ID:", userId);

                            // Send the user ID to your server
                            fetch('api/player-id', {
                                method: 'POST',
                                body: JSON.stringify({ onesignal_subscription_id: userId }),
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Add CSRF token if needed
                                }
                            }).then(response => response.json())
                                .then(data => console.log('Server response:', data))
                                .catch(error => console.error('Error:', error));
                        }
                    });
                } else {
                    console.log("Push notifications are not enabled yet.");
                }
            });
        });
    </script>
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">
    @include('layouts.navigation')

    <!-- Page Heading -->
    @if (isset($header))
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            {{ $header }}
        </div>
    </header>
    @endif

    <!-- Page Content -->
    <main>
        {{ $slot }}
        @yield('content')
    </main>
</div>
@notifyJs
</body>
</html>
