@extends('layoutss.admin.master')

@section('content')
<div class="text-center mt-5">
    <div class="card shadow-lg p-5" id="payment-card">
        <h2 class="mb-4" id="payment-heading">Payment Screenshot</h2>

        <img src="{{ asset('uploads/payments/' . basename($transaction->payment_screenshot)) }}" 
             alt="Payment Screenshot"
             class="img-fluid rounded"
             id="payment-image">

        <div class="mt-4" id="go-back-button">
            <a href="{{ url()->previous() }}" class="btn btn-secondary" id="back-btn">← Go Back</a>
        </div>
    </div>
</div>
@endsection

<style>
/* Unique ID for card */
#payment-card {
    background: #ffffff;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    width: 80%;
    max-width: 900px;
    padding: 40px;
    transition: all 0.4s ease;
    margin: 50px auto;
}

#payment-card:hover {
    transform: scale(1.05);
    box-shadow: 0 15px 50px rgba(0, 0, 0, 0.2);
}

/* Unique ID for heading */
#payment-heading {
    font-size: 2.5rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 20px;
}

/* Unique ID for image */
#payment-image {
    max-height: 600px;
    border-radius: 15px;
    box-shadow: 0 5px 25px rgba(0, 0, 0, 0.15);
    transition: transform 0.3s ease;
    width: 100%; /* Make image responsive */
}

#payment-image:hover {
    transform: scale(1.05) rotate(1deg);
}

/* Unique ID for Go Back button */
#go-back-button {
    margin-top: 20px;
}

#back-btn {
    padding: 12px 25px;
    background: linear-gradient(135deg, #ff6f61, #ffb199);
    color: #fff;
    font-weight: bold;
    border-radius: 25px;
    text-decoration: none;
    transition: all 0.3s ease;
}

#back-btn:hover {
    background: linear-gradient(135deg, #ff0844, #ffb199);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
    transform: translateY(-2px);
}

#back-btn:active {
    transform: translateY(0);
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    #payment-card {
        width: 90%;
        padding: 20px;
    }

    #payment-heading {
        font-size: 2rem;
    }

    #payment-image {
        max-height: 400px;
    }

    #back-btn {
        padding: 10px 20px;
        font-size: 0.95rem;
    }
}

@media (max-width: 576px) {
    #payment-heading {
        font-size: 1.8rem;
    }

    #payment-image {
        max-height: 350px;
    }

    #back-btn {
        padding: 8px 18px;
        font-size: 0.9rem;
    }
}
</style>
