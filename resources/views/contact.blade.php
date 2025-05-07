@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h2 class="text-center font-weight-bold mb-4">Contact Us</h2>
        <p class="text-center mb-5">Need help? Reach us through the form below or contact us via WhatsApp: <strong>+92-XXX-XXXXXXX</strong></p>

        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="contact-form shadow-lg rounded-lg p-5">
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf

                        <!-- Name Input -->
                        <div class="form-group mb-4">
                            <label for="name" class="font-weight-bold">Your Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   name="name" id="name" placeholder="Enter your name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email Input -->
                        <div class="form-group mb-4">
                            <label for="email" class="font-weight-bold">Your Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   name="email" id="email" placeholder="Enter your email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Message Input -->
                        <div class="form-group mb-4">
                            <label for="message" class="font-weight-bold">Your Message</label>
                            <textarea class="form-control @error('message') is-invalid @enderror" 
                                      name="message" id="message" rows="4" placeholder="Write your message" required>{{ old('message') }}</textarea>
                            @error('message')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('styles')
    <style>
body {
    background: linear-gradient(to bottom, #f5f7fa, #c3cfe2);
    font-family: 'Poppins', sans-serif;
    color: #212121;
}

/* Heading */
h2 {
    color: #111;
    font-size: 36px;
    font-weight: 700;
    letter-spacing: -1px;
}

/* Success Message */
.alert-success {
    background: #d4edda;
    color: #155724;
    border-radius: 12px;
    font-size: 1.1rem;
}

/* Contact Form Container */
.contact-form {
    background: rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(10px);
    border-radius: 1.5rem;
    padding: 40px;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease-in-out;
}

/* Labels */
.contact-form label {
    font-weight: 600;
    color: #222;
}

/* Inputs & Textareas */
.contact-form input,
.contact-form textarea {
    border-radius: 12px;
    border: 1px solid #ccd6dd;
    padding: 14px;
    font-size: 16px;
    transition: all 0.3s ease;
    background-color: #f8f9fa;
    color: #212121;
}

.contact-form input:focus,
.contact-form textarea:focus {
    border-color: #66bb6a;
    box-shadow: 0 0 0 0.2rem rgba(102, 187, 106, 0.25);
}

/* Submit Button */
.btn-primary {
    background: linear-gradient(135deg, #4caf50, #2e7d32);
    border: none;
    color: #fff;
    font-weight: 600;
    padding: 14px 32px;
    font-size: 18px;
    border-radius: 50px;
    box-shadow: 0 8px 24px rgba(76, 175, 80, 0.3);
    transition: all 0.3s ease;
    text-transform: uppercase;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #388e3c, #1b5e20);
    transform: translateY(-2px);
    box-shadow: 0 12px 30px rgba(76, 175, 80, 0.4);
}

/* Form Group Spacing */
.form-group {
    margin-bottom: 24px;
}

/* Responsive */
@media (max-width: 767px) {
    .contact-form {
        padding: 24px;
    }

    h2 {
        font-size: 26px;
    }

    .btn-primary {
        width: 100%;
    }
}

    </style>
@endpush
