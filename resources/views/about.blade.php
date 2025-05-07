@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h2 class="text-center font-weight-bold mb-4">About ER-Earning-Resources</h2>
        <p class="text-center mb-5">We offer flexible investment plans with daily earning potential. Join us to take control of your financial future.</p>

        <!-- Introduction Section -->
        <div class="row justify-content-center mb-5">
            <div class="col-md-10 col-lg-8">
                <div class="about-card shadow-lg rounded-lg p-4">
                    <h3 class="text-center font-weight-bold mb-4">Who We Are</h3>
                    <p class="text-center">ER-Earning is a trusted online investment platform that allows you to grow your wealth through simple and flexible investment plans. With daily earnings and withdrawal options, we offer a transparent and easy way to make your money work for you.</p>
                </div>
            </div>
        </div>

        <!-- Why Choose Us Section -->
        <div class="row justify-content-center mb-5">
            <div class="col-md-10 col-lg-8">
                <div class="why-choose-us-card shadow-lg rounded-lg p-4">
                    <h3 class="text-center font-weight-bold mb-4">Why Choose Us?</h3>
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="feature-card text-center p-3">
                                <i class="fas fa-cogs fa-3x text-primary mb-3"></i>
                                <h4 class="font-weight-bold">Flexible Plans</h4>
                                <p>Investment options for every budget, from beginners to pros.</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="feature-card text-center p-3">
                                <i class="fas fa-sync-alt fa-3x text-success mb-3"></i>
                                <h4 class="font-weight-bold">Daily Earnings</h4>
                                <p>Watch your money grow with consistent daily earning.</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="feature-card text-center p-3">
                                <i class="fas fa-lock fa-3x text-danger mb-3"></i>
                                <h4 class="font-weight-bold">Secure & Transparent</h4>
                                <p>Your funds are safe, with real-time updates and clear terms.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- How It Works Section -->
        <div class="row justify-content-center mb-5">
            <div class="col-md-10 col-lg-8">
                <div class="how-it-works-card shadow-lg rounded-lg p-4">
                    <h3 class="text-center font-weight-bold mb-4">How It Works</h3>
                    <p class="text-center">Start in minutes by following these steps:</p>
                    <div class="steps">
                        <div class="step-item">
                            <i class="fas fa-user-plus fa-2x text-info mb-3"></i>
                            <h4 class="font-weight-bold">Step 1: Sign Up</h4>
                            <p>Create your account and verify your identity.</p>
                        </div>
                        <div class="step-item">
                            <i class="fas fa-wallet fa-2x text-warning mb-3"></i>
                            <h4 class="font-weight-bold">Step 2: Choose Your Plan</h4>
                            <p>Pick a plan that fits your budget and goals.</p>
                        </div>
                        <div class="step-item">
                            <i class="fas fa-hand-holding-usd fa-2x text-success mb-3"></i>
                            <h4 class="font-weight-bold">Step 3: Start Earning</h4>
                            <p>Get daily earning directly to your wallet.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Referral Card -->
        <div class="row justify-content-center mt-5">
            <div class="col-md-10 col-lg-8">
                <div class="refer-about-card shadow-lg p-5 rounded text-center">
                    <h3 class="mb-3 font-weight-bold text-dark">🎉 Start Referring & Earning</h3>
                    <p class="lead text-muted">
                        Invite your friends to join <strong>ER-Earning-Resources</strong> and get 
                        <span class="text-success font-weight-bold">PKR 200</span> + 
                        <span class="text-primary font-weight-bold">0.5%</span> daily earning bonus per referral!
                    </p>
                    <a href="{{ url('/dashboard#referralSection') }}" class="btn btn-lg btn-success mt-3">Get Your Referral Link</a>
                </div>
            </div>
        </div>
        
    </div>
@endsection

@push('styles')
    <style>
body {
    background: #f7f9fb;
    font-family: 'Poppins', sans-serif;
    color: #333;
}

/* Section Titles */
h2, h3 {
    color: #111; /* Black headings */
    font-weight: 700;
}

/* Content Cards */
.about-card, .why-choose-us-card, .how-it-works-card {
    background-color: #ffffff;
    border-radius: 1.5rem;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.06);
    transition: all 0.3s ease-in-out;
}
.about-card:hover, .why-choose-us-card:hover, .how-it-works-card:hover {
    transform: translateY(-4px);
}

/* Feature Cards */
.feature-card {
    background-color: #f1f3f5;
    border-radius: 1rem;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.feature-card:hover {
    transform: scale(1.02);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.08);
}
.feature-card h4 {
    color: #1c1c1c;
}
.feature-card p {
    color: #5e5e5e;
}

/* Steps */
.steps .step-item {
    background: #ffffff;
    border-radius: 1rem;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
    transition: all 0.3s ease;
}
.steps .step-item:hover {
    transform: translateY(-5px);
}
.steps .step-item h4 {
    color: #111;
}
.steps .step-item p {
    color: #6c757d;
}

/* Icons */
.fas {
    transition: transform 0.3s ease;
}
.step-item:hover .fas, .feature-card:hover .fas {
    transform: scale(1.1);
}

/* Referral Card */
.refer-about-card {
    background: linear-gradient(145deg, #e0f7e9, #ffffff);
    color: #212121;
    border-left: 6px solid #43a047;
    border-radius: 1.5rem;
    box-shadow: 0 6px 24px rgba(0, 0, 0, 0.08);
    transition: all 0.4s ease-in-out;
}
.refer-about-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 36px rgba(0, 0, 0, 0.1);
}
.refer-about-card h3 {
    font-size: 2rem;
    color: #1b5e20;
}
.refer-about-card p {
    font-size: 1.1rem;
}

/* Buttons */
.btn-success {
    background: linear-gradient(to right, #4caf50, #81c784);
    border: none;
    padding: 12px 25px;
    font-weight: 600;
    border-radius: 30px;
    transition: all 0.3s ease;
}
.btn-success:hover {
    background: linear-gradient(to right, #388e3c, #66bb6a);
    transform: scale(1.05);
}

/* Responsive */
@media (max-width: 768px) {
    h2, h3 {
        font-size: 1.6rem;
    }
    .refer-about-card h3 {
        font-size: 1.5rem;
    }
}

    </style>
@endpush
