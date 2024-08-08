<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../backend/assets/" data-template="vertical-menu-template-free">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="description" content="" />
    <title>Welcome Page</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('../backend/csi_maghreb_logo.jfif') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('../backend/assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('../backend/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('../backend/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('../backend/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('../backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('../backend/assets/vendor/css/pages/page-auth.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('../backend/assets/vendor/js/helpers.js') }}"></script>

    <!-- Config -->
    <script src="{{ asset('../backend/assets/js/config.js') }}"></script>
</head>
<body>
    <!-- Content -->
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Welcome Card -->
                <div class="card">
                    <div class="card-body text-center">
                        <!-- Logo -->
                    <img src="{{ asset('../backend/csi_maghreb_logo1.jpg') }}" alt="CSI Maghreb Logo" width="200" />
                        <!-- /Logo -->
                        <h4 class="mb-2" style="color: #03428e;" >Welcome to CSI</h4>
                        <p class="mb-4">Join us and start the adventure</p>

                        <!-- Welcome Image -->


                        <!-- Buttons -->
                        <div class="d-grid gap-2 d-md-block">
                            <a href="{{ route('login') }}" class="btn rounded-pill btn-primary btn-lg">Sign In</a>
                            <a href="{{ route('register') }}" class="btn rounded-pill btn-secondary btn-lg">Sign Up</a>
                        </div>
                    </div>
                </div>
                <!-- /Welcome Card -->
            </div>
        </div>
    </div>
    <!-- /Content -->

    <!-- Core JS -->
    <script src="{{ asset('../backend/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('../backend/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('../backend/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('../backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('../backend/assets/vendor/js/menu.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('../backend/assets/js/main.js') }}"></script>

    <!-- OneSignal SDK -->
    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async></script>
    <script>
        window.onesignal || (window.onesignal = []);
        window.onesignal.push(function() {
            window.onesignal.init({
                appId: 'f815d9fe-2803-44f4-886d-0ede2d40ba52',
                notifyButton: {
                    enable: true,
                },
                welcomeNotification: {
                    enable: true,
                },
            });

            window.onesignal.getUserId().then(userId => {
                if (userId) {
                    localStorage.setItem('os-user', userId);

                    // Send the userId to your server
                    fetch('/save-user-id', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ userId: userId })
                    })
                        .then(response => response.json())
                        .then(data => console.log('User ID saved:', data))
                        .catch(error => console.error('Error:', error));
                }
            });
        });
    </script>

    <!-- reCaptcha Script -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>
</html>
