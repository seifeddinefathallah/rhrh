<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../backend/assets/" data-template="vertical-menu-template-free">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="description" content="" />
    <title>Login Page</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('../backend/csi_maghreb_logo1.jpg') }}" />

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
                <!-- Login Form -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="index.html" class="app-brand-link gap-2">
                                <img src="{{ asset('../backend/csi_maghreb_logo1.jpg') }}" alt="CSI Maghreb Logo" width="150" />
                               <!--     <span class="app-brand-text demo text-body fw-bolder">CSI</span>-->
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2" style="color: #03428e;  text-align: center;" >Welcome to CSI</h4>
                        <p class="mb-4"    style="text-align: center;">Please sign-in to your account and start the adventure</p>

                        <!-- Login Form -->
                        <form method="POST" action="{{ route('login') }}" id="login-form">
                            @csrf

                            <!-- Email or Username -->
                            <div class="form-group mb-3">
                                <x-input-label for="input_type" :value="__('Email/Username')" />
                                <x-text-input id="input_type" class="form-control {{ $errors->has('input_type') ? 'is-invalid' : '' }}" type="text" name="input_type" :value="old('input_type')" autofocus />
                                <x-input-error :messages="$errors->get('input_type')" class="invalid-feedback" />
                            </div>

                            <!-- Password -->
                            <div class="form-group mb-3">
                                <x-input-label for="password" :value="__('Password')" />
                                <x-text-input id="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" autocomplete="current-password" />
                                <x-input-error :messages="$errors->get('password')" class="invalid-feedback" />
                            </div>

                            <!-- Remember Me -->
                            <div class="form-check mb-3">
                                <x-text-input id="remember_me" type="checkbox" class="form-check-input" name="remember" />
                                <x-input-label for="remember_me" :value="__('Remember me')" class="form-check-label" />
                            </div>



                            <div class="d-flex justify-content-between align-items-center">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link p-0" href="{{ route('password.request') }}">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                @endif
                                <x-primary-button class="btn btn-primary">
                                    {{ __('Log in') }}
                                </x-primary-button>
                            </div>
                        <!-- /Login Form-->

                        <!-- Register Link -->
                        <p class="text-center">
                            <span>New on our platform?</span>
                            <a  href="{{  route('register') }}">
                                <span>Create an account</span>

                            </a>
                        </p>
                        <!-- /Register Link -->
                    </div>
                </div>
                <!-- /Login Card -->
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

    <script src="https://cdn.onesignal.com/sdks/web/v16/OneSignalSDK.page.js" defer></script>
    <script>
        window.OneSignalDeferred = window.OneSignalDeferred || [];
        OneSignalDeferred.push(async function(OneSignal) {
            await OneSignal.init({
                appId: "f815d9fe-2803-44f4-886d-0ede2d40ba52",
            });
            console.log(OneSignal.User.PushSubscription.id);
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if (session('status'))
            Swal.fire({
                title: 'Success! 🎉',
                text: "{{ session('status') }}",
                icon: 'success',
                confirmButtonText: 'OK'
            });
            @elseif ($errors->any())
            Swal.fire({
                title: 'Oops! 😓',
                text: "{{ implode(' ', $errors->all()) }}",
                icon: 'error',
                confirmButtonText: 'OK'
            });
            @endif
        });
    </script>
</body>
</html>