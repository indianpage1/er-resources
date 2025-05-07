@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
        font-family: 'Poppins', sans-serif;
    }

    .payment-section {
        padding: 60px 20px;
    }

    .heading-primary {
        font-size: 2.5rem;
        font-weight: 700;
        background: linear-gradient(90deg, #0d6efd, #6610f2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-align: center;
        margin-bottom: 40px;
    }

    .card-custom {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        background: white;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        transition: all 0.4s ease;
    }

    .card-custom:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.15);
    }

    .card-header-custom {
        background: linear-gradient(90deg, #0dcaf0, #0d6efd);
        color: white;
        text-align: center;
        padding: 25px;
        font-size: 1.5rem;
        font-weight: 700;
    }

    .list-group-item {
        font-size: 1.1rem;
        font-weight: 500;
        border: none;
        padding: 15px 20px;
    }

    .btn-primary, .btn-success {
        border-radius: 50px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: 0.3s ease-in-out;
    }

    .btn-primary:hover, .btn-success:hover {
        transform: scale(1.05);
    }

    .alert-info {
        background: linear-gradient(90deg, #e0f7ff, #d0ebff);
        color: #0c5460;
        border-left: 5px solid #17a2b8;
        font-weight: 500;
        border-radius: 10px;
        padding: 15px;
    }

    @media (max-width: 768px) {
        .card-custom {
            margin-bottom: 30px;
        }
    }
</style>

<div class="container payment-section">
    <h2 class="heading-primary">✨ Confirm Your Payment</h2>

    <div class="row justify-content-center">
        {{-- Plan Details Card --}}
        <div class="col-md-5 mb-4">
            <div class="card card-custom">
                <div class="card-header-custom">Selected Plan</div>
                <div class="card-body">
                    <ul class="list-group list-group-flush text-center">
                        <li class="list-group-item">
                            <strong>Investment Amount:</strong><br>
                            <span class="text-success fs-5">₨ {{ number_format($planDetails['amount']) }}</span>
                        </li>
                        <li class="list-group-item">
                            <strong>Daily Earning:</strong><br>
                            <span class="text-info fs-5">₨ {{ number_format($planDetails['daily_return']) }}</span>
                        </li>
                        <li class="list-group-item">
                            <strong>Withdrawal Limit:</strong><br>
                            <span class="text-warning fs-5">₨ {{ number_format($planDetails['withdrawal_limit']) }}</span>
                        </li>
                    </ul>
                </div>
                <div class="card-footer text-center bg-white">
                    <button class="btn btn-primary w-75">Join Now</button>
                </div>
            </div>
        </div>

        {{-- Payment Form Card --}}
        <div class="col-md-7">
            <div class="card card-custom">
                <div class="card-body">
                    <h4 class="text-center text-primary fw-bold mb-3">Make a Payment</h4>
                    <p class="text-center text-dark">
                        Send your payment via <strong>EasyPaisa / JazzCash</strong> to:
                        <br>
                        <span class="h4 text-danger fw-bold">0309-1148338</span>
                    </p>

                    <form method="POST" action="{{ route('payment.submit') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="plan_Name" value="{{ $planDetails['plan_name'] ?? '' }}">
                        <input type="hidden" name="plan_id" value="{{ $planDetails['id'] ?? '' }}">
                        <input type="hidden" name="amount" value="{{ $planDetails['amount'] ?? '' }}">

                        <div class="mb-3">
                            <label for="payment_screenshot" class="form-label fw-bold">Upload Payment Screenshot:</label>
                            <input type="file" name="payment_screenshot" class="form-control" required>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-success btn-lg">Submit Payment</button>
                        </div>
                    </form>

                    <div class="alert alert-info text-center mt-4">
                        <strong>Confirm your deposit:</strong> Please wait <strong>15 minutes</strong> for confirmation.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
