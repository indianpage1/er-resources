@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-5 text-primary display-4">Investment Calculator</h2>
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-lg border-0 rounded-lg overflow-hidden">
                <div class="card-body p-5">
                    <form id="calculator-form">
                        @csrf

                        <!-- Amount Input -->
                        <div class="mb-4">
                            <label for="amount" class="form-label h5">Enter Amount (PKR)</label>
                            <input type="number"
                                   id="amount"
                                   name="amount"
                                   class="form-control form-control-lg"
                                   placeholder="0.00"
                                   required
                                   min="0"
                                   step="any">
                        </div>

                        <!-- Calculate Button -->
                        <div class="d-grid">
                            <button type="button"
                                    id="calculate-button"
                                    class="btn btn-primary btn-lg py-3 fw-bold">
                                Calculate
                            </button>
                        </div>
                    </form>

                    <!-- Dynamic Results -->
                    <div id="result-section" class="mt-5" style="display:none;">
                        <h4 class="mb-4 text-secondary">Results</h4>
                        <div class="mb-3">
                            <span class="d-block fw-semibold">Daily Earnings</span>
                            <span id="daily-earnings" class="fs-4">PKR 0.00</span>
                        </div>
                        <div class="mb-3">
                            <span class="d-block fw-semibold">Withdrawal Limit</span>
                            <span id="withdrawal-limit" class="fs-4">PKR 0.00</span>
                        </div>
                        <div class="mb-3">
                            <span class="d-block fw-semibold">1‑Year Projection</span>
                            <span id="projected-earnings" class="fs-4">PKR 0.00</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    body { background-color: #f0f4f8; }
    .card { border-radius: 20px; background: #ffffff; }
    .form-label { font-size: 1.25rem; }
    .form-control { border-radius: 10px; padding: 1.25rem; font-size: 1.1rem; }
    .form-control:focus { box-shadow: 0 0 10px rgba(29,78,216,0.2); border-color: #1d4ed8; }
    .btn-primary {
        background-color: #1d4ed8; border: none; font-size: 1.25rem;
        transition: transform 0.2s ease;
    }
    .btn-primary:hover { background-color: #1e40af; transform: translateY(-2px); }
    #result-section h4 { font-size: 1.75rem; }
    #result-section .fw-semibold { font-size: 1.1rem; color: #334155; }
    #result-section .fs-4 { font-size: 1.5rem; color: #0f172a; }
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function() {
    const $amt = $('#amount'),
          $btn = $('#calculate-button'),
          $res = $('#result-section'),
          $daily = $('#daily-earnings'),
          $with  = $('#withdrawal-limit'),
          $proj  = $('#projected-earnings');

    function formatPKR(num) {
        return 'PKR ' + num.toFixed(2)
            .replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    }

    function calculate() {
        const amt = parseFloat($amt.val());
        if (isNaN(amt) || amt <= 0) {
            return $res.hide();
        }
        const daily = amt * 0.05,
              withL = amt * 0.25,
              proj  = daily * 365 * 1;

        $daily.text(formatPKR(daily));
        $with .text(formatPKR(withL));
        $proj .text(formatPKR(proj));

        $res.show();
    }

    $btn.on('click', calculate);
});
</script>
@endpush
