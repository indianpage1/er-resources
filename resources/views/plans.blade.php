@extends('layouts.app')


@section('content')
<div class="floating-icon">
    <a href="{{ route('calculator') }}" class="btn btn-primary" title="Open Calculator">
        <i class="fas fa-calculator"></i>
    </a>
</div>

<div class="container py-5">
    <h2 class="text-center mb-5 fw-bold text-primary">Choose Your Investment Plan</h2>
    <div class="row justify-content-center">
        @foreach($plans as $index => $plan)
            <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100">
                    <!-- Gradient Header -->
                    <div class="card-header bg-gradient text-white text-center py-4" style="background: linear-gradient(135deg, #1c3d75, #17a2b8);">
                        <h5 class="mb-0 text-uppercase fw-bold">{{ $plan->plan_name ?? 'Plan ' . ($index + 1) }}</h5>
                    </div>

                    <div class="card-body p-4">
                        <ul class="list-unstyled mb-4">
                            <li class="mb-3 d-flex align-items-center">
                                <i class="fas fa-money-bill-wave text-success me-3 fs-5"></i>
                                <span><strong>Invest:</strong> {{ number_format($plan->amount) }} PKR</span>
                            </li>
                            <li class="mb-3 d-flex align-items-center">
                                <i class="fas fa-coins text-warning me-3 fs-5"></i>
                                <span><strong>Daily Earning:</strong> {{ number_format($plan->daily_return) }} PKR</span>
                            </li>
                            <li class="mb-3 d-flex align-items-center">
                                <i class="fas fa-hand-holding-usd text-danger me-3 fs-5"></i>
                                <span><strong>Withdrawal Limit:</strong> {{ number_format($plan->withdrawal_limit) }} PKR</span>
                            </li>
                            <li class="mb-3 d-flex align-items-center">
                                <i class="fas fa-clock text-info me-3 fs-5"></i>
                                <span><strong>Time Period:</strong> 1 Year</span>
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="fas fa-shield-alt text-secondary me-3 fs-5"></i>
                                <span><strong>Risk Level:</strong> Safe (No Risk)</span>
                            </li>
                        </ul>
                        @php
                        $isPurchased = in_array($plan->id, $purchasedPlanIds ?? []);
                    @endphp
                    
                    @if($isPurchased)
                    <button class="btn btn-secondary w-100 rounded-pill fw-semibold" disabled style="cursor: not-allowed;">
                        Already Purchased
                    </button>
                        
                    
                    @else
                        <a href="{{ route('payment.page', [
                            'id' => $plan->id,
                            'plan_name' => $plan->plan_name,
                            'amount' => $plan->amount,
                            'daily_return' => $plan->daily_return,
                            'withdrawal_limit' => $plan->withdrawal_limit
                        ]) }}" class="btn btn-outline-primary w-100 rounded-pill fw-semibold">
                            Choose This Plan
                        </a>
                    @endif
                    

                    </div>

                    <div class="card-footer bg-light text-center small text-muted py-3">
                        Invite friends and get <strong class="text-success">+0.5%</strong> on your daily reward.
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection


@push('styles')

    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet" />

    <style>

    body {
        background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
        font-family: 'Poppins', sans-serif;
    }

         .bg-gradient {
        background: linear-gradient(135deg, #1c3d75, #17a2b8) !important;
    }

    .rounded-4 {
        border-radius: 1rem !important;
    }

    .fw-semibold {
        font-weight: 600;
    }

    .fs-5 {
        font-size: 1.25rem !important;
    }

    .floating-icon .btn {
        border-radius: 50%;
        width: 60px;
        height: 60px;
        font-size: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        transition: transform 0.2s ease-in-out;
    }

    .floating-icon .btn:hover {
        transform: scale(1.1);
    }
        /* Floating calculator icon */
        .floating-icon {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 999;
        }

        .floating-icon .btn {
            border-radius: 50%;
            width: 60px;
            height: 60px;
            font-size: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s ease-in-out;
        }

        .floating-icon .btn:hover {
            transform: scale(1.1);
        }

        .floating-icon i {
            font-size: 30px;
            color: white;
        }

        /* Card Container */
        .card.hover-card {
            perspective: 1500px;
            transition: transform 0.3s ease-in-out;
            border-radius: 15px;
        }

        .card-inner {
            position: relative;
            width: 100%;
            height: 100%;
            transform-style: preserve-3d;
            transition: transform 0.5s ease-in-out;
        }

        .card-front,
        .card-back {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
            border-radius: 15px;
        }

        .card-front {
            background-color: #f9f9f9;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        .card-back {
            background-color: #f0f0f0;
            transform: rotateY(180deg);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 20px;
            transition: padding 0.3s ease;
        }

        .font-weight-bold {
            font-weight: 700;
        }

        .text-primary {
            color: #1c3d75 !important;
        }

        .text-success {
            color: #28a745 !important;
        }

        .text-danger {
            color: #dc3545 !important;
        }

        .text-info {
            color: #17a2b8 !important;
        }

        .text-muted {
            color: #6c757d !important;
        }

        /* Hover Effect */
        .card.hover-card:hover .card-inner {
            transform: rotateY(180deg);
        }

        /* Responsive Design */
        @media (max-width: 767px) {
            .card-body {
                padding: 15px;
            }

            .font-weight-bold {
                font-size: 18px;
            }

            .text-success,
            .text-danger,
            .text-info {
                font-size: 14px;
            }

            .btn-primary {
                font-size: 14px;
                padding: 8px 16px;
            }

            .floating-icon .btn {
                width: 50px;
                height: 50px;
            }

            .col-md-6, .col-lg-4 {
                flex: 100%;
            }
        }
    </style>
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@endpush
