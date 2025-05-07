@extends('layoutss.admin.master')

@section('content')
<div class="container">
    <!-- Back Button -->
    <div class="mb-4">
        <a href="{{ url()->previous() }}" class="btn-custom back-btn">← Back</a>
    </div>
    
    <h3 class="mb-4">Transaction Details</h3>
    
    <div class="card p-3 mb-3">
        <div class="row">
            <div class="col-md-6">
                <p><strong>Transaction ID:</strong> {{ $transaction->id }}</p>
                <p><strong>User ID:</strong> {{ $transaction->user_id }}</p>
                <p><strong>User Name:</strong> {{ $transaction->user_name }}</p>
                <p><strong>Plan Amount:</strong> PKR {{ number_format($transaction->plan_amount, 0, '.', ',') }}</p>
            </div>  
            <div class="col-md-6">
                <p><strong>Created At:</strong> {{ $transaction->created_at->format('Y-m-d H:i') }}</p>
                <p><strong>Updated At:</strong> {{ $transaction->updated_at->format('Y-m-d H:i') }}</p>
            </div>
        </div>
        
        <div class="mt-3">
            <strong>Payment Screenshot:</strong><br>
            @if($transaction->payment_screenshot)
                <img src="{{ asset($transaction->payment_screenshot) }}" class="img-fluid" alt="Payment Screenshot">
                <br>
                <!-- Add a Download button for the payment screenshot -->
                <a href="{{ asset($transaction->payment_screenshot) }}" download class="btn-custom download-btn mt-3">Download Screenshot</a>
            @else
                <p>No screenshot uploaded.</p>
            @endif
        </div>

        <div class="mt-4">
            <!-- Edit and Delete Actions -->
            <a href="{{ route('admin.transactions.edit', $transaction->id) }}" class="btn-custom edit-btn">✏️ Edit</a>
        
            <!-- Delete Form -->
            <form action="{{ route('admin.transactions.destroy', $transaction->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-custom delete-btn" onclick="return confirm('Are you sure to delete this transaction?')">🗑️ Delete</button>
            </form>
        </div>
        
    </div>
</div>

<style>
    /* Back Button */
    .back-btn {
        background: linear-gradient(135deg, #6c757d, #495057);
        padding: 10px 20px;
        font-size: 1rem;
        border-radius: 12px;
    }

    .back-btn:hover {
        background: linear-gradient(135deg, #495057, #6c757d);
        transform: scale(1.05);
    }

    /* Custom Button Styles */
    .btn-custom {
        display: inline-block;
        padding: 0.6rem 1.2rem;
        font-size: 0.95rem;
        font-weight: 700;
        text-transform: uppercase;
        border: none;
        border-radius: 50px;
        transition: all 0.3s ease-in-out;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        color: #fff;
        text-decoration: none;
        margin-right: 0.5rem;
        cursor: pointer;
    }

    /* Edit Button */
    .edit-btn {
        background: linear-gradient(135deg, #f6c343, #f08a24);
        margin-right: 1rem;
    }

    .edit-btn:hover {
        background: linear-gradient(135deg, #f08a24, #f6c343);
        transform: scale(1.05);
    }

    /* Delete Button */
    .delete-btn {
        background: linear-gradient(135deg, #ff4e50, #f00000);
    }

    .delete-btn:hover {
        background: linear-gradient(135deg, #f00000, #ff4e50);
        transform: scale(1.05);
    }

    /* Download Button */
    .download-btn {
        background: linear-gradient(135deg, #4caf50, #2e7d32);
        font-size: 1rem;
        padding: 0.6rem 1.2rem;
        text-transform: none;
        border-radius: 25px;
        color: #fff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
        margin-top: 1rem;
    }

    .download-btn:hover {
        background: linear-gradient(135deg, #388e3c, #2e7d32);
        transform: scale(1.05);
    }

    .download-btn:active {
        transform: scale(0.98);
    }

    /* Container Styling */
    .container {
        width: 100%;
        margin: 0 auto;
        padding: 20px;
    }

    /* Heading */
    h3 {
        font-size: 30px;
        font-weight: bold;
        margin-bottom: 40px;
    }

    /* Card Styling */
    .card {
        background: linear-gradient(135deg, #fdfbfb 0%, #ebedee 100%);
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        margin: 20px auto;
        width: 70%;
        transition: all 0.4s ease;
        border: 1px solid #e0e0e0;
    }

    .card:hover {
        transform: scale(1.03);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.2);
        background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
    }

    /* Image Styling */
    img.img-fluid {
        max-width: 80%;
        height: auto;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        margin-bottom: 1rem;
    }

    /* Flexbox for Rows */
    .row {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .col-md-6 {
        width: 100%;
        max-width: 48%;
        padding: 0 10px;
        box-sizing: border-box;
    }

    /* Paragraph Styling */
    p {
        font-size: 1.25rem;
        line-height: 1.6;
        color: #333;
        margin-bottom: 1rem;
    }

    strong {
        font-weight: bold;
        color: #000;
    }

    /* Media Queries for Responsiveness */
    @media (max-width: 768px) {
        .card {
            width: 100%;
            padding: 20px;
        }

        .col-md-6 {
            width: 100%;
        }

        h3 {
            font-size: 26px;
        }

        p {
            font-size: 1.1rem;
        }

        .download-btn {
            width: 100%;
            padding: 0.8rem;
        }
    }
</style>
@endsection
