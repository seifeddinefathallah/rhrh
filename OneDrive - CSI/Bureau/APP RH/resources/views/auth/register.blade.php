<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../backend/assets/" data-template="vertical-menu-template-free">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="description" content="" />
    <title>Register Page</title>

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
                        <h5 class="mb-2" style="text-align: center;color: #03428e;">Welcome to CSI</h5>
                        <p class="mb-4" style=" text-align: center;">Please sign-up to your account and start the adventure</p>

         
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name"  class="form-control" type="text" name="name" :value="old('name')"  autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Username -->
        <div class="mt-4">
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input   class="form-control" id="username"  type="text" name="username" :value="old('username')"  />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input  class="form-control"  id="email"  type="email" name="email" :value="old('email')"  />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input  class="form-control"  id="password" 
                          type="password"
                          name="password"
                          autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input  class="form-control" id="password_confirmation" 
                          type="password"
                          name="password_confirmation"  />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
    <div  class="mt-4">
        <button type="submit" class="btn btn-primary d-grid w-100">
             
            {{ __('Register') }}
        </button>
    </div>
       <!-- <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                { __('Already registered?') }}
            </a>

   
        </div>-->

    </form>



    <p class="text-center">
        <span>Already have an account?</span>
        <a  href="{{ route('auth.login') }}">
          <span>Login</span> 
        
        </a>
      </p>
    </div>
  </div>
  <!-- /Register -->
</div>
</div>
</div>

<!-- / Content -->



  <!-- Core JS -->
  <script src="{{ asset('../backend/assets/vendor/libs/jquery/jquery.js') }}"></script>
  <script src="{{ asset('../backend/assets/vendor/libs/popper/popper.js') }}"></script>
  <script src="{{ asset('../backend/assets/vendor/js/bootstrap.js') }}"></script>
  <script src="{{ asset('../backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
  <script src="{{ asset('../backend/assets/vendor/js/menu.js') }}"></script>

  <!-- Main JS -->
  <script src="{{ asset('../backend/assets/js/main.js') }}"></script>

<!-- Page JS -->

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
</body>
</html>


