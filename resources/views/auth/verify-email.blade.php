@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-6">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header text-center bg-primary text-white py-4">
                        <img src="{{ asset('path/to/logo.png') }}" alt="Logo" class="img-fluid mb-3" style="max-width: 120px;">
                        <h2 class="mb-0">{{ __('Verify Your Email Address') }}</h2>
                    </div>

                    <div class="card-body p-4 text-center">
                        <p class="mb-4 text-sm text-gray-600">
                            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                        </p>

                        @if (session('status') == 'verification-link-sent')
                            <div class="alert alert-success mb-4" role="alert">
                                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                            </div>
                        @endif

                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <form method="POST" action="{{ route('verification.send') }}" id="resend-verification-form">
                                @csrf
                                <button type="submit" class="btn btn-primary" id="resend-verification-button">
                                    {{ __('Resend Verification Email') }}
                                </button>
                            </form>

                            <form method="POST" action="{{ route('logout') }}" class="ml-3" id="logout-form">
                                @csrf
                                <button type="submit" class="btn btn-link text-decoration-none text-gray-600">
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if (session('status') == 'verification-link-sent')
            Swal.fire({
                title: 'Check Your Email! 📧',
                text: "{{ __('A new verification link has been sent to the email address you provided during registration.') }}",
                icon: 'success',
                confirmButtonText: 'OK'
            });
            @endif

            document.getElementById('resend-verification-button').addEventListener('click', function (event) {
                event.preventDefault(); // Prevent the form from submitting immediately

                Swal.fire({
                    title: 'Sending Verification Email... ⏳',
                    text: "We are sending you a new verification email.",
                    icon: 'info',
                    showConfirmButton: false
                });

                // Submit the form after showing the SweetAlert2
                document.getElementById('resend-verification-form').submit();
            });

            document.getElementById('logout-form').addEventListener('submit', function (event) {
                event.preventDefault(); // Prevent the form from submitting immediately

                Swal.fire({
                    title: 'Logging Out... 👋',
                    text: "You are about to log out.",
                    icon: 'warning',
                    showConfirmButton: false,
                    timer: 1500 // Wait for 1.5 seconds
                }).then(() => {
                    // Submit the form after showing the SweetAlert2
                    document.getElementById('logout-form').submit();
                });
            });
        });
    </script>
@endsection
