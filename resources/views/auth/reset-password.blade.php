@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-6">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header text-center bg-primary text-white py-4">
                        <img src="{{ asset('path/to/logo.png') }}" alt="Logo" class="img-fluid mb-3" style="max-width: 120px;">
                        <h2 class="mb-0">{{ __('Reset Password') }}</h2>
                    </div>

                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('password.store') }}">
                            @csrf

                            <!-- Password Reset Token -->
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            <!-- Email or Username -->
                            <div class="form-group">
                                <x-input-label for="input_type" :value="__('Email/Username')" />
                                <x-text-input id="input_type" class="form-control" type="text" name="input_type" :value="old('input_type', $request->input_type)" required autofocus />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                <x-input-error :messages="$errors->get('username')" class="mt-2" />
                            </div>

                            <!-- Password -->
                            <div class="form-group mt-4">
                                <x-input-label for="password" :value="__('Password')" />
                                <x-text-input id="password" class="form-control" type="password" name="password" required />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <!-- Confirm Password -->
                            <div class="form-group mt-4">
                                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                <x-text-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required />
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>

                            <div class="form-group mt-4 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
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
                title: 'Success!🎉',
                text: "{{ session('status') }}",
                icon: 'success',
                confirmButtonText: 'OK'
            });
            @elseif ($errors->any())
            Swal.fire({
                title: 'Error!😕',
                text: "{{ implode(' ', $errors->all()) }}",
                icon: 'error',
                confirmButtonText: 'OK'
            });
            @endif
        });
    </script>
@endsection
