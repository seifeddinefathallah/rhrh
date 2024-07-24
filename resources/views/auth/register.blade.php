@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-6">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header text-center bg-primary text-white py-4">
                        <img src="{{ asset('path/to/logo.png') }}" alt="Logo" class="img-fluid mb-3" style="max-width: 120px;">
                        <h2 class="mb-0">{{ __('Register') }}</h2>
                    </div>

                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('register') }}" id="registration-form">
                            @csrf

                            <!-- Name -->
                            <div class="form-group mb-3">
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" :value="old('name')" autofocus />
                                <x-input-error :messages="$errors->get('name')" class="invalid-feedback" />
                            </div>

                            <!-- Username -->
                            <div class="form-group mb-3">
                                <x-input-label for="username" :value="__('Username')" />
                                <x-text-input id="username" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" type="text" name="username" :value="old('username')" />
                                <x-input-error :messages="$errors->get('username')" class="invalid-feedback" />
                            </div>

                            <!-- Email Address -->
                            <div class="form-group mb-3">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" :value="old('email')" />
                                <x-input-error :messages="$errors->get('email')" class="invalid-feedback" />
                            </div>

                            <!-- Password -->
                            <div class="form-group mb-3">
                                <x-input-label for="password" :value="__('Password')" />
                                <x-text-input id="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password')" class="invalid-feedback" />
                            </div>

                            <!-- Confirm Password -->
                            <div class="form-group mb-4">
                                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                <x-text-input id="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" type="password" name="password_confirmation" />
                                <x-input-error :messages="$errors->get('password_confirmation')" class="invalid-feedback" />
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <a class="btn btn-link p-0" href="{{ route('login') }}">
                                    {{ __('Already registered?') }}
                                </a>
                                <x-primary-button class="btn btn-primary">
                                    {{ __('Register') }}
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
@endsection
