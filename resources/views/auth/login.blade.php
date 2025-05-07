@extends('layouts.app')

@section('content')
<div class="container d-flex align-items-center justify-content-center min-vh-100 py-5">
    <div class="col-12 col-md-8 col-lg-5">
        <div class="glass-card p-5 rounded-4 shadow-lg">
            <h2 class="text-center mb-4 fw-bold text-gradient display-6">Welcome Back 👋</h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-floating mb-4">
                    <input type="email" name="email" id="email" class="form-control bg-transparent text-light border-0 border-bottom border-secondary rounded-0" placeholder="Email" required>
                    <label for="email" class="text-light">Email address</label>
                </div>

                <div class="form-floating mb-4">
                    <input type="password" name="password" id="password" class="form-control bg-transparent text-light border-0 border-bottom border-secondary rounded-0" placeholder="Password" required>
                    <label for="password" class="text-light">Password</label>
                </div>

                <div class="d-grid mb-4">
                    <button type="submit" class="btn btn-primary btn-lg rounded-4 shadow">Login</button>
                </div>
            </form>
            <div class="text-center mt-3 small text-black">
                <p>Don't have an account? 
                    <a href="{{ route('register') }}" class="text-primary text-decoration-none fw-bold hover-glow">Register Now</a>
                </p>
            </div>
            
        </div>
    </div>
</div>
  @endsection