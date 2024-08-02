@extends('layouts.app')

@section('content')
    <!--<div class="container py-12">-->
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" id="password-reset-request-form">
        @csrf

        <!-- Email or Username -->
        <div>
            <x-input-label for="input_type" :value="__('Email/Username')" />
            <x-text-input id="input_type" class="block mt-1 w-full" type="text" name="input_type" :value="old('input_type')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if (session('status'))
            Swal.fire({
                title: 'Check Your Email! 📧',
                text: "Link sent successfully! Please check your emails! ",
                icon: 'success',
                confirmButtonText: 'OK'
            });
            @elseif ($errors->any())
            Swal.fire({
                title: 'Error! 😕',
                text: "Verify your Email or Username",
                icon: 'error',
                confirmButtonText: 'OK'
            });
            @endif
        });
    </script>
@endsection
