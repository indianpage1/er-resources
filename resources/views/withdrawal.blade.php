@extends('layouts.app')

@section('content')
@if($latestWithdrawal)
    @php
        $status = $latestWithdrawal->status;
        $now = \Carbon\Carbon::now();
        $nextAllowedTime = \Carbon\Carbon::parse($latestWithdrawal->created_at)->addHours(24);
        $canWithdraw = $now->greaterThanOrEqualTo($nextAllowedTime);
    @endphp

    <div id="statusCard" class="card shadow-sm mb-4">
        <div class="card-body">
            @if ($status === 'pending')
                <p id="statusMessage" class="mt-3 mb-0 fw-semibold status-message status-pending">
                    ⏳ Please wait 1 hour. Your withdrawal is in process. Decision pending.
                </p>
            @elseif ($status === 'rejected')
                <p id="statusMessage" class="mt-3 mb-0 fw-semibold status-message status-rejected">
                    ❌ Check and add another account. Your account was invalid. Send request again.
                </p>
            @elseif ($status === 'approved' && $canWithdraw)
                <p id="statusMessage" class="mt-3 mb-0 fw-semibold status-message status-approved">
                    ✅ Your withdrawal amount was successful. Enjoy! You can now make a new withdrawal.
                </p>
            @endif

            {{-- Cooldown message (only if approved but still in cooldown) --}}
            @if ($status === 'approved' && !$canWithdraw)
                @php
                    $remainingTime = $now->diff($nextAllowedTime);
                    $hours = $remainingTime->h;
                    $minutes = $remainingTime->i;
                @endphp
                <div class="alert alert-warning mt-3">
                    ⚠️ You can make your next withdrawal in 
                    <strong>
                        {{ $hours > 0 ? $hours . ' hour' . ($hours > 1 ? 's' : '') : '' }}
                        {{ $minutes > 0 ? ($hours > 0 ? ' and ' : '') . $minutes . ' minute' . ($minutes > 1 ? 's' : '') : '' }}
                    </strong>.
                </div>
            @endif
        </div>
    </div>
@endif

<style>
        .status-message {
        padding: 1rem 1.5rem;
        border-radius: 1rem;
        font-size: 1.5rem; /* Increase the font size */
        line-height: 1.6;
        font-weight: bold;
        display: inline-block;
        color: #333; /* Darker text color */
    }

    .status-message.status-pending {
        background-color: #fff3cd;
        color: #856404; /* Dark color for better visibility */
        border: 1px solid #ffeeba;
    }

    .status-message.status-rejected {
        background-color: #f8d7da;
        color: #721c24; /* Dark color for better visibility */
        border: 1px solid #f5c6cb;
    }

    .status-message.status-approved {
        background-color: #d4edda;
        color: #155724; /* Dark color for better visibility */
        border: 1px solid #c3e6cb;
    }

    .status-message {
        transition: all 0.3s ease;
    }

    /* Adding some more styles to increase visibility */
    .status-message.status-pending,
    .status-message.status-rejected,
    .status-message.status-approved {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .status-card {
        transition: opacity 0.5s;
    }

    .status-message {
        transition: color 0.3s ease, font-size 0.3s ease, background-color 0.3s ease;
    }
.status-message.status-pending {
    color: #ffc107;
}
.status-message.status-rejected {
    color: #dc3545;
}
.status-message.status-approved {
    color: #28a745;
}

.status-message {
    padding: 0.75rem 1rem;
    border-radius: 0.5rem;
    font-size: 0.95rem;
    line-height: 1.5;
    display: inline-block;
}


.status-pending {
    background-color: #fff3cd;
    color: #856404;
    border: 1px solid #ffeeba;
}

.status-rejected {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.status-approved {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

    body {
        background-color: #f0faff;
        font-family: 'Segoe UI', sans-serif;
    }

    .card {
        border-radius: 1rem;
        border: none;
        transition: all 0.3s ease-in-out;
    }

    .card:hover {
        box-shadow: 0 0 10px rgba(0, 123, 255, 0.2);
    }

    .text-primary {
        color: #3498db !important;
    }

    .btn-outline-primary {
        border-color: #3498db;
        color: #3498db;
    }

    .btn-outline-primary:hover {
        background-color: #6dcdf2;
        border-color: #6dcdf2;
        color: #000;
    }

    .form-control,
    .form-select {
        font-size: 0.9rem;
        padding: 0.45rem 0.9rem;
    }

    .btn {
        transition: all 0.3s ease-in-out;
    }

    .rounded-pill {
        border-radius: 50rem !important;
    }

    .form-label {
        font-weight: 600;
        font-size: 0.9rem;
    }

    .table th,
    .table td {
        vertical-align: middle;
    }

    @media (max-width: 576px) {
        .btn {
            font-size: 0.85rem;
        }

        .form-control,
        .form-select {
            font-size: 0.85rem;
        }

        .card-body {
            padding: 1rem !important;
        }
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">

            <!-- Balance Display -->
            <div class="card shadow-sm mb-4" style="background: #e0f7ff;">
                <div class="card-body text-center">
                    <h5 class="mb-1 fw-bold text-muted">Your Current Balance</h5>
                    <h2 class="text-primary fw-bold">₨ {{ number_format($currentBalance) }}</h2>
                </div>
            </div>
            
            <div class="card shadow-sm mb-5">
                <div class="card-body p-4">
                    <h5 class="fw-bold text-primary mb-3">Save New Account</h5>
                    <form action="{{ route('withdrawal.saveAccount') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <input type="text" name="account_holder_name" class="form-control form-control-sm rounded-pill" placeholder="Account Holder Name" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="mobile_number" class="form-control form-control-sm rounded-pill" placeholder="Account Number" required>
                            </div>
                            <div class="col-md-6">
                                <select name="method" class="form-select form-select-sm rounded-pill" required>
                                    <option value="">Select Method</option>
                                    <option value="JazzCash">JazzCash</option>                 
                                    <option value="EasyPaisa">EasyPaisa</option>
                                </select>
                            </div>
                            <div class="col-md-6 text-end">
                                <button type="submit" class="btn btn-outline-success rounded-pill px-4">
                                    Save Account
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Withdraw Form -->
            <div class="card shadow-sm mb-5">
                <div class="card-body p-4">
                    <h4 class="mb-4 fw-bold text-primary">Withdraw Request</h4>

                    <form action="{{ route('withdrawal.process') }}" method="POST">
                        @csrf
            
                        <div class="mb-3">
                            <label class="form-label">Select Account</label>
                            <select id="accountSelect" class="form-select form-select-sm rounded-pill">
                                <option value="">Choose Account</option>
                                @foreach ($accounts as $acc)
                                    <option 
                                        value="{{ $acc->mobile_number }}" 
                                        data-name="{{ $acc->account_holder_name }}"
                                        data-method="{{ $acc->method }}">
                                        {{ $acc->method }} - {{ $acc->mobile_number }} ({{ $acc->account_holder_name }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
            
                        <div class="mb-3">
                            <label class="form-label fw-bold">Select Withdrawal Amount</label>
                            <div class="d-flex flex-wrap gap-2">
                                @forelse($userPlans as $plan)
                                    <button type="button"
                                            class="btn btn-outline-primary btn-sm rounded-pill px-4 py-2 fw-semibold amount-btn"
                                            data-amount="{{ $plan->withdrawal_limit }}">
                                        ₨ {{ number_format($plan->withdrawal_limit) }}
                                    </button>
                                @empty
                                    <p class="text-muted">No withdrawal options available. Please buy a plan.</p>
                                @endforelse
                            </div>
                        </div>
            
                        <!-- Hidden Inputs -->
                        <input type="hidden" name="amount" id="selectedAmount">
                        <input type="hidden" name="account_number" id="accountNumberInput">
                        <input type="hidden" name="payment_method" id="paymentMethodInput">
                        <input type="hidden" name="account_holder_name" id="accountHolderNameInput">
            
                        <div class="mb-3">
                            <label class="form-label">Account Holder Name</label>
                            <input type="text" id="accountHolderName" class="form-control form-control-sm rounded-pill" placeholder="e.g. Ali Ahmed" readonly required>
                        </div>
            
                        <div class="form-check my-3">
                            <input class="form-check-input" type="checkbox" id="confirmCheck" required>
                            <label class="form-check-label small text-muted" for="confirmCheck">
                                I confirm this transaction. It may take <strong>1 hour</strong> for processing.
                            </label>
                        </div>
            
                        <button type="submit" class="btn btn-primary w-100 fw-bold py-2 rounded-pill">
                            Submit Withdrawal
                        </button>
                    </form>
                </div>
            </div>
            

            <!-- Save Account Form -->

            <!-- Recent Activity -->
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h5 class="fw-bold text-primary mb-3">Recent Withdrawal Activity</h5>
                    <div class="table-responsive">
                        <table class="table table-sm table-striped align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Amount</th>
                                    <th>Method</th>
                                    <th>Account</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($withdrawals as $index => $withdrawal)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>₨ {{ number_format($withdrawal->withdrawal_amount) }}</td>
                                        <td>{{ $withdrawal->payment_method }}</td>
                                        <td>{{ $withdrawal->account_number }}</td>
                                        <td>
                                            @if ($withdrawal->status === 'pending')
                                                <span class="badge bg-warning text-dark">Pending</span>
                                            @elseif ($withdrawal->status === 'approved')
                                                <span class="badge bg-success">Approved</span>
                                            @elseif ($withdrawal->status === 'rejected')
                                                <span class="badge bg-danger">Rejected</span>
                                            @endif
                                        </td>
                                        <td>{{ $withdrawal->created_at->format('Y-m-d') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">No withdrawals found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>


<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <!-- Balance Display, Withdrawal Form, and other content here... -->

        </div>
    </div>
</div>

<script>
function fetchStatusUpdate() {
    fetch("{{ route('withdrawal.latestStatus') }}")
        .then(response => response.json())
        .then(data => {
            if (!data.status) return;

            const statusText = document.getElementById('statusText');
            const statusMessage = document.getElementById('statusMessage');
            const statusCard = document.getElementById('statusCard');
            const withdrawalFormCard = document.querySelector('form[action=\"{{ route('withdrawal.process') }}\"]')?.closest('.card');

            // ✅ Update status text label
            if (statusText) {
                statusText.textContent = data.status.charAt(0).toUpperCase() + data.status.slice(1);
                statusText.className = '';
                statusText.classList.add('text-' + (
                    data.status === 'pending' ? 'warning' :
                    data.status === 'rejected' ? 'danger' : 'success'
                ));
            }

            // ✅ Update statusMessage content and styling
            if (statusMessage) {
                if (data.status === 'pending') {
                    statusMessage.textContent = '⏳ Please wait 1 hour. Your withdrawal is in process. Decision pending.';
                } else if (data.status === 'rejected') {
                    statusMessage.textContent = '❌ Check and add another account. Your account was invalid. Send request again.';
                } else if (data.status === 'approved') {
                    // ✅ ONLY show success message — cooldown warning is handled in Blade
                    statusMessage.textContent = '✅ Your withdrawal amount was successful. Enjoy!';
                }

                // Apply CSS classes
                statusMessage.className = 'mt-3 mb-0 fw-semibold status-message status-' + data.status;
            }

            // ✅ Update card border color
            if (statusCard) {
                statusCard.className = 'card shadow-sm mb-4 border-start border-5 border-' + (
                    data.status === 'pending' ? 'warning' :
                    data.status === 'rejected' ? 'danger' : 'success'
                );

                // ✅ Hide card after 10 seconds (if not pending)
                if (data.status !== 'pending') {
                    setTimeout(() => {
                        statusCard.style.transition = 'opacity 0.5s';
                        statusCard.style.opacity = '0';
                        setTimeout(() => statusCard.remove(), 500);
                    }, 10000);
                }
            }
        });
}


// 🔄 Poll status every 10 seconds
setInterval(fetchStatusUpdate, 10000);


    document.addEventListener("DOMContentLoaded", function () {
        const buttons = document.querySelectorAll('.amount-btn');
        const selectedAmount = document.getElementById('selectedAmount');
        const accountSelect = document.getElementById('accountSelect');
        const accountHolderInput = document.getElementById('accountHolderName');

        // 💰 Handle amount button clicks
        buttons.forEach(btn => {
            btn.addEventListener('click', () => {
                buttons.forEach(b => b.classList.remove('active', 'btn-primary'));
                buttons.forEach(b => b.classList.add('btn-outline-primary'));
                btn.classList.remove('btn-outline-primary');
                btn.classList.add('active', 'btn-primary');
                selectedAmount.value = btn.dataset.amount;
            });
        });

        // 💳 Autofill account info from dropdown
        accountSelect.addEventListener('change', function () {
            const option = this.options[this.selectedIndex];
            const name = option.getAttribute('data-name') || '';
            const number = option.value;
            const method = option.textContent.split('-')[0].trim();

            accountHolderInput.value = name;
            document.getElementById('accountNumberInput').value = number;
            document.getElementById('paymentMethodInput').value = method;
            document.getElementById('accountHolderNameInput').value = name;
        });
    });

    function handleFormSubmit() {
        alert("Please wait 1 hour, your request is pending.");
        return true;
    }
</script>


@endsection
