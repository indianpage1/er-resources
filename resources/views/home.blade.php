@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <!-- Welcome Message with Company Name -->
    <!-- Bootstrap 5 CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- FontAwesome for icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

        <!-- Hero Section -->
        <div class="hero-section">
            <h1>Earn Daily with ER-Earning-Resources</h1>
            <p>Invest in the Right Plans and Watch Your Money Grow. Secure, Fast, and Profitable.</p>
            <a href="{{ route('plans') }}" class="btn">Get Started</a>
        </div>
        
        <!-- Why Choose Us Section -->
        <div class="row justify-content-center text-center my-5">
            <div class="col-md-4">
                <i class="fas fa-lock fa-3x text-success mb-3"></i>
                <h4>Secure Platform</h4>
                <p>Your investments are protected with the latest security measures.</p>
            </div>
            <div class="col-md-4">
                <i class="fas fa-bolt fa-3x text-warning mb-3"></i>
                <h4>Fast Payouts</h4>
                <p>Withdraw your earnings quickly with JazzCash or Easypaisa.</p>
            </div>
            <div class="col-md-4">
                <i class="fas fa-users fa-3x text-info mb-3"></i>
                <h4>Trusted by 10,000+ Users</h4>
                <p>Join a community of satisfied investors and start earning daily!</p>
            </div>
        </div>
<!-- Refer & Earn Promo Card -->

<!-- Top Investment Plans Section -->

<div class="container my-5">
    <h2 class="text-center fw-bold mb-5 display-4 text-gradient">💰 Top Investment Plans</h2>
    <div class="row g-4 justify-content-center">
        <div class="col-md-4">
            <div class="plan-wrapper starter text-center">
                <div class="plan-icon text-success"><i class="fas fa-leaf"></i></div>
                <h4 class="fw-bold text-success">Starter Plan</h4>
                <p class="mt-2">Invest ₨ 1,000</p>
                <p><strong>Earn Daily 5%</strong></p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="plan-wrapper gold text-center">
                <div class="plan-icon text-warning"><i class="fas fa-gem"></i></div>
                <h4 class="fw-bold text-warning">Gold Plan</h4>
                <p class="mt-2">Invest ₨ 5,000</p>
                <p><strong>Earn Daily 8%</strong></p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="plan-wrapper pro text-center">
                <div class="plan-icon text-danger"><i class="fas fa-fire"></i></div>
                <h4 class="fw-bold text-danger">Pro Plan</h4>
                <p class="mt-2">Invest ₨ 10,000+</p>
                <p><strong>Earn Daily 10%</strong></p>
            </div>
        </div>
    </div>
</div>
            
            <div class="row justify-content-center mb-5">
                <div class="col-md-10">
                    <div class="refer-home-card shadow-lg p-4 rounded text-center">
                        <h3 class="mb-3 text-dark font-weight-bold">💼 Refer & Earn</h3>
                        <p class="lead mb-2">
                            Invite your friends to <strong>ER-Earning-Resources</strong> and earn 
                            <span class="text-success font-weight-bold">PKR 200</span> per referral!
                        </p>
                        <p class="mb-3 text-muted">Plus, get a <span class="text-primary font-weight-bold">0.5% daily earning boost</span> for each active referral. More referrals = more daily income!</p>
                        <a href="{{ url('/dashboard#referralSection') }}" class="btn btn-primary btn-lg mt-2">Start Referring Now</a>
                    </div>
                </div>
            </div>
        <!-- Testimonials Section -->
        <div class="container my-5">
            <h2 class="text-center font-weight-bold mb-4 text-primary">What Our Users Say</h2>
            <div class="row justify-content-center">
                <div class="col-md-4 mb-4">
                    <div class="testimonial-card p-4 rounded text-center shadow-lg">
                        <p>"ER-Earning has changed my life! I started with the Starter Plan and now my earnings are growing daily."</p>
                        <h5>- Sarah K.</h5>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="testimonial-card p-4 rounded text-center shadow-lg">
                        <p>"I love how easy it is to withdraw my earnings! Great customer service and a reliable platform."</p>
                        <h5>- Ali M.</h5>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    @endsection
    
    
    
  @push('styles')
  @push('styles')
<style>
    body {
        background: linear-gradient(135deg, #f9fbff, #eaf3ff);
        font-family: 'Segoe UI', sans-serif;
    }
    .hero-section {
    background: linear-gradient(to right, #ffffff, #f0f9ff); /* Light gradient */
    padding: 60px 0;
    text-align: center;
    border-radius: 1rem;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
}

.hero-section h1 {
    font-size: 3rem;
    font-weight: 800;
    background: linear-gradient(90deg, #007bff, #00c6ff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    margin-bottom: 15px;
    display: inline-block;
    position: relative;
}

.hero-section h1::before {
    content: "💸";
    position: absolute;
    left: -40px;
    top: 0;
    font-size: 2.5rem;
}

.hero-section p {
    font-size: 1.1rem;
    color: #555;
    max-width: 600px;
    margin: 0 auto 25px;
}

.hero-section .btn {
    background: linear-gradient(to right, #007bff, #00c6ff);
    color: #fff;
    padding: 14px 32px;
    font-size: 16px;
    border: none;
    border-radius: 50px;
    box-shadow: 0 4px 15px rgba(0, 123, 255, 0.4);
    transition: all 0.3s ease-in-out;
}

.hero-section .btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(0, 123, 255, 0.5);
}


    .plan-wrapper {
        backdrop-filter: blur(15px);
        background: rgba(255, 255, 255, 0.8);
        border-radius: 2rem;
        padding: 2rem;
        border: 2px solid rgba(0,0,0,0.05);
        box-shadow: 0 8px 30px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }

    .plan-wrapper:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 45px rgba(0,0,0,0.15);
    }

    .plan-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
        transition: transform 0.3s ease;
    }

    .plan-wrapper:hover .plan-icon {
        transform: scale(1.2) rotate(-5deg);
    }

    .text-gradient {
        background: linear-gradient(to right, #007bff, #00c6ff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .refer-home-card {
        background: #f1f8ff;
        border-left: 8px solid #007bff;
        border-radius: 1.5rem;
        position: relative;
        overflow: hidden;
    }

    .refer-home-card::before {
        content: "🔥 Bonus";
        position: absolute;
        top: 0;
        right: 0;
        background: #ff4757;
        color: white;
        padding: 5px 15px;
        font-weight: bold;
        clip-path: polygon(0 0, 100% 0, 70% 100%, 0% 100%);
    }

    .refer-home-card:hover {
        transform: scale(1.02);
        box-shadow: 0 12px 30px rgba(0,0,0,0.1);
    }

    .testimonial-card {
        background: #fff;
        border-radius: 1rem;
        position: relative;
        padding: 2rem;
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    }

    .testimonial-card::before {
        content: "“";
        font-size: 5rem;
        position: absolute;
        top: -30px;
        left: 20px;
        color: #007bff;
        opacity: 0.2;
        z-index: 0;
    }

    .testimonial-card p {
        font-style: italic;
        color: #444;
        z-index: 1;
        position: relative;
    }

    .testimonial-card h5 {
        font-weight: bold;
        margin-top: 1rem;
        z-index: 1;
        position: relative;
    }

    .row .col-md-4 {
        transition: transform 0.3s;
    }

    .row .col-md-4:hover {
        transform: scale(1.02);
    }

    .row .col-md-4 h4 {
        font-weight: 700;
        font-size: 1.3rem;
    }

    .row .col-md-4 i {
        font-size: 2.5rem;
        margin-bottom: 10px;
        transition: transform 0.3s ease;
    }

    .row .col-md-4:hover i {
        transform: scale(1.2) rotate(10deg);
    }

    @media (max-width: 768px) {
        .hero-section h1 {
            font-size: 2.5rem;
        }

        .testimonial-card {
            padding: 1.5rem;
        }
    }
    .plan-wrapper {
    border: 2px solid rgba(255,255,255,0.5);
    box-shadow: 0 0 10px rgba(0, 123, 255, 0.2);
}

</style>
@endpush

@endpush
