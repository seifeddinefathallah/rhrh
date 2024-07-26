@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-6">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header text-center bg-primary text-white py-4">
                        <img src="{{ asset('path/to/logo.png') }}" alt="Logo" class="img-fluid mb-3" style="max-width: 120px;">
                        <h2 class="mb-0">{{ __('Login') }}</h2>
                    </div>

                    <div class="card-body p-4">
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
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection
