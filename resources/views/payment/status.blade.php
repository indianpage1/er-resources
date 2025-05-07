@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-5 font-weight-bold text-primary">Payment Status</h2>

    <div class="card shadow-lg p-4 mb-4">
        <div class="card-body">
            <h5 class="text-center">Payment for Plan: <strong>{{ $transaction->plan_number }}</strong></h5>
            <h6 class="text-center mb-4">Status: 
                <span id="status" class="badge 
                    @if($transaction->status == 'accepted') bg-success 
                    @elseif($transaction->status == 'rejected') bg-danger 
                    @else bg-warning @endif">
                    {{ ucfirst($transaction->status) }}
                </span>
            </h6>

            <div class="row justify-content-center mb-4">
                <div class="col-md-6 text-center">
                    <h5>Time Remaining: <span id="timer">00:00</span></h5>
                </div>
            </div>

            <div class="row justify-content-center mt-4">
                <div class="col-md-8">
                    <div class="alert 
                        @if($transaction->status == 'accepted') alert-success
                        @elseif($transaction->status == 'rejected') alert-danger
                        @else alert-info @endif text-center">
                        @if($transaction->status == 'pending')
                            Please wait. Your payment status is pending.
                        @elseif($transaction->status == 'accepted')
                            Payment received successfully. Your plan is now active.
                        @elseif($transaction->status == 'rejected')
                            We couldn't receive your payment. Please check your payment details.
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-group mt-5">
                <label for="statusUpdateForm">Admin Status Update:</label>
                <textarea id="statusUpdateForm" class="form-control" rows="3" readonly>
                    @if($transaction->status == 'pending') Your payment is under review.
                    @elseif($transaction->status == 'accepted') Your payment has been accepted! Your plan is now active.
                    @elseif($transaction->status == 'rejected') Your payment was rejected. Please ensure your payment was completed correctly.
                    @endif
                </textarea>
            </div>

            {{-- Show the button only if the status is accepted --}}
            @if($transaction->status == 'accepted')
                <div class="text-center mt-4">
                    <a href="{{ route('reward.index') }}" class="btn btn-primary btn-lg">Click here to Earnings Page</a>
                </div>
            @endif

        </div>
    </div>
</div>

<script>
   let timeRemaining = {{ $timeRemaining }}; // 15 minutes in seconds for pending status
let timerElement = document.getElementById('timer');
let timerInterval;

// Function to format time in mm:ss format
function formatTime(seconds) {
    let minutes = Math.floor(seconds / 60);
    let secs = seconds % 60;
    return `${minutes < 10 ? '0' : ''}${minutes}:${secs < 10 ? '0' : ''}${secs}`;
}

// Function to update the timer every second
function updateTimer() {
    if (timeRemaining <= 0) {
        clearInterval(timerInterval);
        document.getElementById('status').textContent = 'Time expired!';  // Optional: change status message
    } else {
        timerElement.textContent = formatTime(timeRemaining);
        timeRemaining--;
        localStorage.setItem('timeRemaining', timeRemaining); // Save to localStorage
    }
}

// If there's a stored timeRemaining in localStorage, use it
if (localStorage.getItem('timeRemaining') && {{ $timeRemaining }} == 15 * 60) {
    // Reset timer if status is pending (15 minutes)
    timeRemaining = parseInt(localStorage.getItem('timeRemaining'));
} else if ({{ $timeRemaining }} == 0) {
    // If it's zero, ensure the timer stops
    localStorage.removeItem('timeRemaining'); // Remove any existing countdown data
}

timerInterval = setInterval(updateTimer, 1000);

// Stop the timer when the page is closed or refreshed
window.onbeforeunload = function() {
    clearInterval(timerInterval);
};

    </script>
    
    
    
@endsection

@push('styles')

<style>
/* Responsive page styles */
.container {
    max-width: 1200px;
    margin: 0 auto;
}

.card {
    background: #f8f9fa;
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    padding: 20px;
}

.card-body {
    padding: 20px;
}

#status {
    font-size: 16px;
    padding: 10px 20px;
    text-transform: capitalize;
}

h5, h6 {
    font-weight: bold;
    margin-bottom: 20px;
}

#timer {
    font-size: 2rem;
    color: #ff0000;
    font-weight: bold;
}

.form-control {
    font-size: 1.2rem;
    height: 60px;
}

.alert-info {
    font-size: 1.2rem;
    font-weight: bold;
}

.alert-success {
    font-size: 1.2rem;
    font-weight: bold;
    background-color: #28a745;
    color: #fff;
}

.alert-danger {
    font-size: 1.2rem;
    font-weight: bold;
    background-color: #dc3545;
    color: #fff;
}

@media (max-width: 768px) {
    #timer {
        font-size: 1.5rem;
    }

    .form-control {
        font-size: 1rem;
    }
}

@media (max-width: 576px) {
    .container {
        padding: 10px;
    }
}
</style>
@endpush
