@extends('layoutss.admin.master')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">View Contact Message</h2>

    <div class="card shadow-lg rounded-lg border-0">
        <div class="card-header bg-gradient-success text-white">
            <h4 class="mb-0" style="color: black;">Contact Message Details</h4>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-4"><strong>Name:</strong></div>
                <div class="col-md-8">{{ $contact->name }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4"><strong>Email:</strong></div>
                <div class="col-md-8">{{ $contact->email }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4"><strong>Message:</strong></div>
                <div class="col-md-8">{{ $contact->message }}</div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('contacts.index') }}" class="btn btn-primary btn-sm">Back to List</a>
                <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-warning btn-sm">Edit</a>
            </div>
        </div>
    </div>
</div>
<style>
    /* General Styles */
.container {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 15px;
}

h2 {
    font-size: 32px;
    color: #333;
    font-weight: bold;
    text-align: center;
    margin-bottom: 40px;
}

/* Card Styles */
.card {
    border-radius: 8px;
    border: none;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.card-header {
    background-color: #f8f9fa;
    border-bottom: 2px solid #ddd;
    padding: 15px;
    text-align: center;
}

.card-body {
    padding: 25px;
}

.card-body .form-label {
    font-weight: bold;
    font-size: 16px;
}

/* Form Inputs */
.form-control {
    border-radius: 5px;
    padding: 10px;
    border: 1px solid #ddd;
}

textarea.form-control {
    min-height: 150px;
}

/* Button Styles */
.btn {
    padding: 10px 20px;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
}

.btn-primary {
    background-color: #007bff;
    color: white;
}

.btn-primary:hover {
    background-color: #0056b3;
}

.btn-success {
    background-color: #28a745;
    color: white;
}

.btn-success:hover {
    background-color: #218838;
}

.btn-warning {
    background-color: #ffc107;
    color: white;
}

.btn-warning:hover {
    background-color: #e0a800;
}

.btn-secondary {
    background-color: #6c757d;
    color: white;
}

.btn-secondary:hover {
    background-color: #5a6268;
}

/* Responsive Styles */
@media (max-width: 768px) {
    h2 {
        font-size: 28px;
    }

    .card-body {
        padding: 20px;
    }

    .btn {
        padding: 8px 16px;
    }

    .form-control {
        font-size: 14px;
    }

    .card-header {
        font-size: 18px;
    }
}

@media (max-width: 576px) {
    h2 {
        font-size: 24px;
    }

    .card-body {
        padding: 15px;
    }

    .form-control {
        font-size: 14px;
    }
}

</style>
@endsection
