@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h2 class="text-center mb-5 font-weight-bold text-primary">User Dashboard</h2>

        <!-- Stats Cards -->
        <div class="row text-center mb-4">
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card shadow-sm border-left-primary">
                    <div class="card-body">
                        <h6>Total Balance</h6>
                        <h5 class="text-success">PKR {{ number_format(Auth::user()->walletSummary->total_earning ?? 0, 2) }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card shadow-sm border-left-info">
                    <div class="card-body">
                        <h6>Total Withdrawals</h6>
                        <h5 class="text-danger">PKR {{ number_format($walletSummary->total_withdrawal ?? 0) }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card shadow-sm border-left-warning">
                    <div class="card-body">
                        <h6>Referrals</h6>
                        <h5 class="text-warning">{{ Auth::user()->total_referred_users ?? 0 }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="card shadow-sm border-left-dark">
                    <div class="card-body">
                        <h6>Joined</h6>
                        <h5 class="text-muted">{{ Auth::user()->created_at->format('d M, Y') }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- Welcome & Balance -->
        @php
        $groupedPlans = $activePlans->groupBy('plan_name');
    @endphp
    
    <div class="row justify-content-center mb-4" id="referralSection">
        <div class="col-md-8 col-sm-12">
            <div class="card shadow-lg rounded-lg p-4 mb-4">
                <div class="card-body">
                    <h3 class="text-center text-muted mb-3">Welcome, {{ Auth::user()->name }}</h3>
                    <h5 class="text-center text-success">Current Balance: PKR {{ Auth::user()->main_wallet ?? 0 }}</h5>
    
                    @if($activePlans->isNotEmpty())
                    <h4 class="text-center text-dark mt-3">
                        Active Plan{{ $activePlans->count() > 1 ? 's' : '' }}:
                    </h4>
                    
                        <div class="d-flex flex-wrap justify-content-center mt-2 gap-2">
                            @foreach($groupedPlans as $planName => $plans)
                                <span class="badge bg-info text-dark px-3 py-2 rounded-pill">
                                    {{ $planName }}@if($plans->count()>1) × {{ $plans->count() }}@endif
                                </span>
                            @endforeach
                        </div>
                    @else
                        <h5 class="text-center text-danger mt-3">No Active Plan</h5>
                    @endif
                </div>
            </div>
        </div>
    </div>
    

        <!-- Referral Link -->
        <div class="row justify-content-center mb-4">
            <div class="col-md-8 col-sm-12">
                @php
                    $referralLink = url('/register?ref=' . Auth::user()->referral_code);
                @endphp
                <!-- Referral Bonus Info Card -->
                <div class="row justify-content-center mb-4">
                    <div class="col-md-8 col-sm-12">
                        <div class="card refer-card shadow-lg border-0 text-center p-4">
                            <div class="card-body">
                                <h5 class="font-weight-bold text-dark mb-2">💸 Add Refer User & Earn</h5>
                                <p class="text-muted mb-0">Earn <span class="text-success font-weight-bold">PKR 200</span> & get a <span class="text-primary font-weight-bold">0.5%</span> boost in your daily earnings!</p>
                            </div>
                        </div>
                    </div>
                </div>
        
                <div class="input-group mb-3">
                    <input type="text" id="refLink" class="form-control" value="{{ $referralLink }}" readonly>
                    <button class="btn btn-outline-primary" onclick="copyRef()">Copy</button>
                </div>
                <small id="copyMsg" class="text-success" style="display:none;">Copied!</small>
            </div>
        </div>
        

        <!-- Timer Section -->
  

        <!-- Recent Transactions (Dummy Static Table) -->
        <div class="row justify-content-center mb-4">
            <div class="col-md-10">
                <div class="card p-3 shadow-sm">
                    <h5 class="mb-3">Recent Activity</h5>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="activityTable">
                                @foreach($activities as $index => $activity)
                                    <tr class="activity-row {{ $index < 3 ? 'visible' : '' }}" data-id="{{ $activity['id'] }}">
                                        <td>{{ \Carbon\Carbon::parse($activity['date'])->format('M d, Y') }}</td>
                                        <td>{{ $activity['type'] }}</td>
                                        <td>PKR {{ number_format($activity['amount']) }}</td>
                                        <td class="{{ $activity['status'] === 'Pending' ? 'text-danger' : 'text-success' }}">
                                            {{ $activity['status'] }}
                                        </td>
                                        <td>
                                            <form action="{{ route('dashboard') }}" method="GET" style="display:inline;">
                                                <input type="hidden" name="delete_activity_id" value="{{ $activity['id'] }}">
                                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            
                        </table>
                        @if(count($activities) > 4)
                            <div class="text-center mt-2">
                                <button class="btn btn-primary btn-sm" id="toggleActivity">Read More</button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Motivational Tip -->
        <div class="row justify-content-center mb-5">
            <div class="col-md-8 col-sm-12">
                <div class="alert alert-info shadow-sm text-center">
                    💡 <strong>Tip:</strong> Reinvest your earnings to grow faster. Stay consistent and watch your balance grow!
                </div>
            </div>
        </div>
    </div>
 <script>
   
    document.getElementById('toggleActivity')?.addEventListener('click', function () {
        document.querySelectorAll('.activity-row').forEach(row => row.classList.add('visible'));
        this.style.display = 'none';
    });
        // Function to copy referral link to clipboard
    document.addEventListener("DOMContentLoaded", function() {
        const hash = window.location.hash;
        if (hash === "#referralSection") {
            const el = document.querySelector(hash);
            if (el) {
                el.scrollIntoView({ behavior: "smooth" });
            }
        }
    });

        function copyRef() {
            const copyText = document.getElementById("refLink");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");

            const msg = document.getElementById("copyMsg");
            msg.style.display = "inline";
            setTimeout(() => {
                msg.style.display = "none";
            }, 1500);
        }
    </script>
@endsection


@push('styles')
<style>
      .activity-row {
        display: none;
    }
    .activity-row.visible {
        display: table-row;
    }
    .btn-delete {
        font-size: 0.8rem;
        padding: 2px 8px;
    }
    @media (max-width: 768px) {
        .table thead {
            display: none;
        }
        .table tbody tr {
            display: block;
            margin-bottom: 10px;
            border: 1px solid #dee2e6;
            border-radius: 6px;
            padding: 10px;
        }
        .table td {
            display: flex;
            justify-content: space-between;
            padding: 6px 10px;
        }
    }
    /* 🌈 Base Colors & Font */
    body {
        background: linear-gradient(145deg, #f9fbff, #eef3f9);
        font-family: 'Poppins', sans-serif;
        color: #333;
    }

    h2.text-primary {
        background: linear-gradient(90deg, #1c3d75, #00bcd4);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-size: 2.5rem;
    }

    /* 🍭 Card Styling */
    .card {
        border-radius: 20px;
        background: #ffffff;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
        transition: all 0.3s ease-in-out;
        overflow: hidden;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.08);
    }

    .card-body {
        padding: 30px;
    }

    /* 💡 Stat Highlights */
    .card h6 {
        font-weight: 600;
        color: #6c757d;
        margin-bottom: 10px;
    }

    .card h5 {
        font-size: 1.5rem;
        font-weight: bold;
    }

    .border-left-primary {
        border-left: 5px solid #228a1fcc !important;
    }

    .border-left-info {
        border-left: 5px solid #e40f0f !important;
    }

    .border-left-warning {
        border-left: 5px solid #ffc107 !important;
    }

    .border-left-dark {
        border-left: 5px solid #343a40 !important;
    }

    /* 🌟 Referral Card */
    .refer-card {
        background: linear-gradient(145deg, #f0fff0, #e6f7f9);
        border-radius: 16px;
        transition: all 0.3s ease;
        border: 2px dashed #00c853;
    }

    .refer-card:hover {
        transform: scale(1.03);
        box-shadow: 0 12px 20px rgba(0, 200, 83, 0.1);
    }

    .refer-card h5 {
        font-size: 1.6rem;
    }

    .refer-card p {
        font-size: 1rem;
        color: #555;
    }

    /* 🧁 Buttons & Inputs */
    .btn-outline-primary {
        border-radius: 30px;
        padding: 10px 25px;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-outline-primary:hover {
        background: #007bff;
        color: #fff;
    }

    .form-control {
        border-radius: 30px;
        padding: 10px 20px;
        border: 1px solid #dfe6f0;
    }

    /* 🎀 Badges */
    .badge {
        background: #e3f2fd;
        font-weight: 500;
        border-radius: 50px;
        margin: 4px;
        font-size: 0.95rem;
    }

    .badge.bg-info {
        background: #d0f0fd;
    }

    /* 💬 Table */
    .table thead {
        background: #f1f5f9;
    }

    .table-striped tbody tr:nth-child(odd) {
        background-color: #f9fcff;
    }

    .table th,
    .table td {
        vertical-align: middle;
    }

    /* 💎 Tip Box */
    .alert-info {
        background: linear-gradient(to right, #e3f2fd, #f1f8ff);
        border-left: 5px solid #2196f3;
        font-weight: 500;
        border-radius: 15px;
        font-size: 1rem;
    }

    /* 📱 Responsive Magic */
    @media (max-width: 768px) {
        h2.text-primary {
            font-size: 2rem;
        }

        .card-body {
            padding: 20px;
        }

        .btn,
        .form-control {
            font-size: 0.9rem;
        }

        .table {
            font-size: 13px;
        }
    }
</style>
@endpush
