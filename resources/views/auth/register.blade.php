@extends('layouts.app')

@section('content')
<div class="container d-flex align-items-center justify-content-center min-vh-100 py-5">
    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div id="register-card" class="p-5 rounded-4 shadow-lg">
            <h2 id="register-heading" class="text-center mb-4 fw-bold">Create Your Account 🚀</h2>

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div id="error-box" class="alert alert-danger rounded-4 shadow">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-floating mb-4" id="name-field">
                    <input type="text" name="name" id="name" class="form-control" placeholder="Full Name" value="{{ old('name') }}" required>
                    <label for="name" class="form-label-custom">Full Name</label>
                </div>

                <div class="form-floating mb-4" id="city-field">
                    <input type="text" name="city" id="city" class="form-control" placeholder="City" value="{{ old('city') }}" required>
                    <label for="city" class="form-label-custom">City</label>
                </div>

                <div class="form-floating mb-4" id="email-field">
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
                    <label for="email" class="form-label-custom">Email address</label>
                </div>

                <div class="form-floating mb-4" id="password-field">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                    <label for="password" class="form-label-custom">Password</label>
                </div>

                <div class="form-floating mb-4" id="password-confirm-field">
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                    <label for="password_confirmation" class="form-label-custom">Confirm Password</label>
                </div>

                <div class="form-floating mb-4" id="referral-field">
                    <input type="text" name="referral_code" id="referral_code" class="form-control" placeholder="Referral Code" value="{{ request('ref') }}">
                    <label for="referral_code" class="form-label-custom">Referral Code (optional)</label>
                </div>

                <div id="submit-btn" class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary btn-lg rounded-4 shadow">Register Now</button>
                </div>

                <div id="login-link" class="text-center mt-3 small">
                    <p class="text-black">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="text-blue fw-bold text-decoration-none">Login Here</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
{{-- 
@push('styles')
<style>
    /* Body Background */
    body {
        background-color: #1e1e2f;
        font-family: 'Poppins', sans-serif;
    }

    /* Register Card */
    #register-card {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    /* Heading */
    #register-heading {
        color: #00d2ff;
        font-size: 2.4rem;
        letter-spacing: 1px;
        background: linear-gradient(90deg, #00d2ff, #3a7bd5);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Form Controls */
    .form-control {
        background: transparent;
        color: #000;
        font-weight: 500;
        border: none;
        border-bottom: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 0;
        transition: all 0.3s ease;
    }

    .form-control::placeholder {
        color: #000;
    }

    .form-control:focus {
        border-color: #00d2ff;
        box-shadow: 0 0 10px rgba(0, 210, 255, 0.4);
        background: transparent;
    }

    /* Labels */
    .form-label-custom {
        color: #000;
        font-weight: 500;
        font-size: 0.9rem;
    }

    .btn-black {
    background-color: #000000; /* Pure Black */
    color: #ffffff;
    font-weight: 600;
    font-size: 1.1rem;
    letter-spacing: 0.5px;
    border: none;
    padding: 0.75rem 1.5rem;
    transition: all 0.4s ease;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
}

.btn-black:hover {
    background-color: #0d0d0d; /* Slightly deeper black on hover */
    transform: translateY(-2px) scale(1.02);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.8);
}

    /* Login Text */
    #login-link .text-black {
        color: #000;
    }

    #login-link .text-blue {
        color: #00d2ff;
        transition: 0.3s;
    }

    #login-link .text-blue:hover {
        color: #ffffff;
        text-decoration: underline;
    }

    /* Error Box */
    #error-box {
        background-color: rgba(255, 0, 0, 0.1);
        border: 1px solid rgba(255, 0, 0, 0.2);
        color: #ff4d4d;
    }

    /* Responsive Tweaks */
    @media (max-width: 768px) {
        #register-card {
            padding: 2rem;
        }
    }

    @media (max-width: 576px) {
        #register-heading {
            font-size: 1.8rem;
        }
    }
</style>
@endpush --}}
