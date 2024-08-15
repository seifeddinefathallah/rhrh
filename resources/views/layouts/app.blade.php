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
    @stack('styles')
</head>
<body class="hold-transition sidebar-mini ">
    <div class="wrapper">

        @include('layouts.navigation')

        <!-- Page Heading    include('layouts.partials.navbar')-->
        @isset($header)
        <header class="bg-white shadow">
            <div class="content-wrapper">
                {{ $header }}
            </div>
        </header>
        @endisset

        <!-- Page Content -->
        <section class="container-fluid d-flex flex-row align-items-center ms-auto">
            @yield('content')
        </section>

        @livewireScripts
    </div>
    @stack('scripts')
</body>
</html>
