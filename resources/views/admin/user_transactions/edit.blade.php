@extends('layoutss.admin.master')

@section('content')
<div class="container">
    <h3 class="mb-4 text-center text-primary">Edit Transaction</h3>

    <form action="{{ route('admin.transactions.update', $transaction->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-5 shadow rounded-lg">
        @csrf
        @method('PUT')

        <div class="form-group mb-4">
            <label for="plan_number" class="font-weight-bold">Plan Number</label>
            <input type="text" class="form-control form-control-lg" id="plan_number" name="plan_number" value="{{ old('plan_number', $transaction->plan_number) }}" placeholder="Enter plan number" required>
        </div>

        <div class="form-group mb-4">
            <label for="payment_screenshot" class="font-weight-bold">Payment Screenshot</label>
            <input type="file" class="form-control form-control-lg" id="payment_screenshot" name="payment_screenshot">
            <div class="img-set">
                <!-- Check if there's a payment screenshot to display -->
                @if($transaction->payment_screenshot && file_exists(public_path($transaction->payment_screenshot)))
                    <img src="{{ asset($transaction->payment_screenshot) }}" alt="Payment Screenshot" width="200" height="200" class="img-fluid">
                @else
                    <p>No screenshot available</p>
                @endif
            </div>
        </div>

        <div class="d-flex justify-content-between flex-column flex-sm-row">
            <!-- Back Button -->
            <a href="{{ route('admin.transactions.index') }}" class="btn btn-secondary btn-lg rounded-pill mb-2 mb-sm-0">Back</a>

            <!-- Update Button -->
            <button type="submit" class="btn btn-success btn-lg rounded-pill shadow">Update Transaction</button>
        </div>
    </form>
</div>

<style>
    h3 {
        margin: 20px;
        font-size: 30px;
    }

    /* General page styling */
    body {
        background-color: #ffffff;
    }

    .container {
        margin-top: 30px;
    }

    /* Form styling */
    form {
        background-color: #ffffff;
        padding: 30px;
        border-radius: 10px;
        max-width: 600px;
        margin: 0 auto;
        margin-top: 55px;
        box-shadow: 0px 4px 6px rgb(0, 0, 0);
    }

    /* Labels */
    label {
        display: block;
        font-size: 1.1rem;
        font-weight: 500;
        color: #333;
        margin-bottom: 8px;
    }

    /* Input fields */
    input[type="text"],
    input[type="file"] {
        width: 100%;
        border-radius: 8px;
        border: 1px solid #ccc;
        padding: 12px;
        font-size: 1rem;
        margin-bottom: 20px;
    }

    input[type="text"]:focus,
    input[type="file"]:focus {
        border-color: #007bff;
        outline: none;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
    }

    /* Buttons */
    button[type="submit"],
    .btn-secondary {
        font-size: 1.1rem;
        padding: 12px 25px;
        border-radius: 25px;
        transition: all 0.3s ease;
    }

    /* Submit Button Specific */
    button[type="submit"] {
        background-color: #28a745;
        color: white;
        border: none;
    }

    button[type="submit"]:hover {
        background-color: #218838;
    }

    /* Back Button */
    .btn-secondary {
        background-color: #6c757d;
        color: white;
        text-decoration: none;
        display: inline-block;
        text-align: center;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .container {
            margin-top: 20px;
        }

        form {
            padding: 20px;
            margin: 0 15px;
        }

        /* Make buttons full width */
        button[type="submit"],
        .btn-secondary {
            width: 100%;
            margin-bottom: 10px;
        }

        .img-set {
            text-align: center;
        }

        .img-set img {
            width: 100%;
            height: auto;
        }
    }

    /* For smaller mobile screens */
    @media (max-width: 576px) {
        h3 {
            font-size: 24px;
        }

        form {
            padding: 15px;
            margin: 0 10px;
        }

        label {
            font-size: 1rem;
        }

        input[type="text"],
        input[type="file"] {
            padding: 10px;
            font-size: 0.95rem;
        }

        button[type="submit"],
        .btn-secondary {
            font-size: 1rem;
            padding: 10px 20px;
        }
    }
</style>

@endsection
