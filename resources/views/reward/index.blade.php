@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<div class="container py-5">
    <h1 class="text-center text-gradient mb-5">💰 ER-Earning-Resources</h1>

    {{-- Total Earnings Card --}}
    <div class="d-flex justify-content-center mb-5">
        <div class="card total-earned-card text-center">
            <div class="card-body">
                <i class="bi bi-coin" style="font-size: 2.5rem; color: #FFEB3B;"></i> <!-- Yellow Dollar Sign -->
                <h5 class="mt-3">Total Earned</h5>
                <h3 class="text-primary">{{ $userPlans->sum('total_earning') }} PKR</h3>
                <small class="text-muted">Your total earnings so far!</small>
            </div>
        </div>
    </div>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Earning Cards --}}
    <div class="row g-4">
        @foreach($userPlans as $plan)
        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="card plan-card h-100">
                <div class="card-header plan-header text-center">
                    <span class="plan-name">{{ $plan->plan_name }}</span>
                </div>
                <div class="card-body d-flex flex-column justify-content-between">
                    <p><strong>Daily Reward:</strong> {{ $plan->daily_earning }} Coins</p>
                    
                    <button class="btn btn-claim mt-auto" id="claimButton{{ $loop->index }}" data-bs-toggle="modal" data-bs-target="#claimModal{{ $loop->index }}">
                        🚀 Claim Now
                    </button>

                    <div id="claimedMessage{{ $loop->index }}" class="claimed-message text-center mt-2" style="display: none;">
                        ✅ Claimed Recently
                        <div id="timer{{ $loop->index }}" class="fw-bold text-danger mt-1"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Claim Modal --}}
        <div class="modal fade" id="claimModal{{ $loop->index }}" tabindex="-1" aria-labelledby="claimModalLabel{{ $loop->index }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-4">
                    <div class="modal-header bg-gradient text-white">
                        <h5 class="modal-title">Confirm Claim</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        You're claiming <strong>{{ $plan->daily_earning }} Coins</strong> for <strong>{{ $plan->plan_name }}</strong>. Proceed?
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('reward.claim', ['planId' => $plan->plan_id]) }}" method="POST">
                            @csrf
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Claim</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- JS Timer --}}
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const btn = document.getElementById("claimButton{{ $loop->index }}");
                const msg = document.getElementById("claimedMessage{{ $loop->index }}");
                const timer = document.getElementById("timer{{ $loop->index }}");

                let lastClaimed = "{{ $plan->last_claimed }}";
                let endTime = lastClaimed ? new Date("{{ \Carbon\Carbon::parse($plan->last_claimed)->addHours(24)->toIso8601String() }}").getTime() : 0;

                function updateTimer() {
                    const now = new Date().getTime();
                    const dist = endTime - now;
                    if (dist <= 0) {
                        btn.style.display = 'block';
                        msg.style.display = 'none';
                    } else {
                        btn.style.display = 'none';
                        msg.style.display = 'block';
                        const h = Math.floor((dist % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        const m = Math.floor((dist % (1000 * 60 * 60)) / (1000 * 60));
                        const s = Math.floor((dist % (1000 * 60)) / 1000);
                        timer.innerHTML = `⏳ ${String(h).padStart(2, '0')}:${String(m).padStart(2, '0')}:${String(s).padStart(2, '0')}`;
                        setTimeout(updateTimer, 1000);
                    }
                }

                updateTimer();

                btn.addEventListener("click", () => {
                    endTime = new Date().getTime() + 86400000;
                    updateTimer();
                });
            });
        </script>
        @endforeach
    </div>

    {{-- Reward History Table --}}
    <div class="mt-5">
        <h4 class="text-center mb-4">📊 Reward History</h4>
        <div class="table-responsive">
            <table class="table table-striped table-hover shadow-sm rounded">
                <thead class="table-dark">
                    <tr>
                        <th>Plan</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Daily Earned</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userPlans as $plan)
                    <tr>
                        <td>{{ $plan->plan_name }}</td>
                        <td>{{ $plan->created_at->format('Y-m-d') }}</td>
                        <td>
                            <span class="badge {{ $plan->last_claimed ? 'bg-success' : 'bg-secondary' }}">
                                {{ $plan->last_claimed ? 'Claimed' : 'Not Claimed' }}
                            </span>
                        </td>
                        <td>{{ $plan->daily_earning }} PKR</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@push('styles')
<style>
    /* Google Font */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

    body {
        background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
        color: #333;
    }

    .text-gradient {
        /* background: linear-gradient(to right, #00c6ff, #0072ff); */
        /* -webkit-background-clip: text; */
        /* -webkit-text-fill-color: transparent; */
        font-weight: 800;
        font-size: 2.8rem;
    }

    .total-earned-card {
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        padding: 25px;
        transition: transform 0.3s ease;
    }

    .total-earned-card:hover {
        transform: scale(1.03);
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
    }

    .plan-card {
        background: #ffffff;
        border-radius: 20px;
        border: none;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        transition: transform 0.4s ease, box-shadow 0.4s ease;
    }

    .plan-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
    }

    .plan-header {
        background: linear-gradient(135deg, #0072ff, #00c6ff);
        color: #fff;
        padding: 15px;
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
        font-size: 1.1rem;
        font-weight: 600;
    }

    .btn-claim {
        background: linear-gradient(135deg, #00b09b, #96c93d);
        color: white;
        font-weight: 600;
        border: none;
        padding: 10px 15px;
        border-radius: 12px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .btn-claim:hover {
        background: linear-gradient(135deg, #76b852, #8DC26F);
        transform: scale(1.05);
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
    }

    .claimed-message {
        font-size: 0.9rem;
        color: #555;
        opacity: 0.85;
    }

    .table {
        background: #ffffff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.07);
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #e0f7fa;
    }

    .modal-content {
        border-radius: 20px;
        overflow: hidden;
    }

    .modal-header.bg-gradient {
        background: linear-gradient(to right, #0072ff, #00c6ff);
    }

    .badge.bg-success {
        background-color: #43a047 !important;
    }

    .badge.bg-secondary {
        background-color: #757575 !important;
    }

    .bi-coin {
        color: #fbc02d;
    }

    @media (max-width: 768px) {
        .text-gradient {
            font-size: 2rem;
        }

        .total-earned-card {
            padding: 20px;
        }
    }
</style>
@endpush


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endpush
