<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CSI') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>


    <script src="https://cdn.onesignal.com/sdks/web/v16/OneSignalSDK.page.js" defer></script>
    <script>
        window.OneSignalDeferred = window.OneSignalDeferred || [];
        OneSignalDeferred.push(async function(OneSignal) {
            await OneSignal.init({
                appId: "f815d9fe-2803-44f4-886d-0ede2d40ba52",
            });

            const userId = await OneSignal.User.PushSubscription.id;
            if (userId) {
                console.log('User ID:', userId);
                try {
                    const response = await fetch('/save-push-subscription-id', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                        body: JSON.stringify({ pushSubscriptionId: userId })
                    });

                    if (response.ok) {
                        const data = await response.json();
                        console.log('User ID saved:', data);
                    } else {
                        const errorText = await response.text();
                        console.error('Error saving PushSubscription ID:', errorText);
                    }
                } catch (error) {
                    console.error('Error saving PushSubscription ID:', error);
                }
            }
        });
    </script>
     @livewireStyles
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endisset

    <!-- Page Content -->
<main id="main-content" class="container-fluid" >
    @yield('content')
</main>

@livewireScripts


</body>
</html>
