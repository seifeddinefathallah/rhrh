@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-6">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header text-center bg-primary text-white py-4">
                        <img src="{{ asset('path/to/logo.png') }}" alt="Logo" class="img-fluid mb-3" style="max-width: 120px;">
                        <h2 class="mb-0">{{ __('Forgot Password') }}</h2>
                    </div>

                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('password.email') }}" id="password-reset-request-form">
                            @csrf

                            <div class="mb-4 text-sm text-gray-600">
                                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                            </div>

                            <!-- Email or Username -->
                            <div class="form-group">
                                <x-input-label for="input_type" :value="__('Email/Username')" />
                                <x-text-input id="input_type" class="form-control" type="text" name="input_type" :value="old('input_type')" required autofocus />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                <x-input-error :messages="$errors->get('username')" class="mt-2" />
                            </div>

                            <div class="form-group mt-4 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary" id="password-reset-request-button">
                                    {{ __('Email Password Reset Link') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 -->
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
