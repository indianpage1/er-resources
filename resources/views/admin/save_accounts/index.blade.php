@extends('layoutss.admin.master')

@section('content')
<div class="container py-4">
    <h3 class="text-primary fw-bold mb-4">Manage Withdrawal Accounts</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive rounded shadow-sm bg-white p-3">
        <table class="table table-bordered align-middle text-center mb-0">
            <thead class="table-light">
                <tr class="align-middle">
                    <th>#</th>
                    <th>Account Holder</th>
                    <th>Mobile Number</th>
                    <th>Method</th>
                    <th>User ID</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($accounts as $index => $account)
                    <tr class="table-row">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $account->account_holder_name }}</td>
                        <td>{{ $account->mobile_number }}</td>
                        <td>
                            <span class="badge bg-info text-dark px-3 py-1 rounded-pill">{{ $account->method }}</span>
                        </td>
                        <td><span class="text-muted">{{ $account->user_id }}</span></td>
                        <td>
                            <a href="{{ route('admin.save-accounts.edit', $account->id) }}"
                                class="btn btn-sm btn-outline-primary rounded-pill px-3 me-1">
                                Edit
                             </a>
                                                         <form action="{{ route('admin.save-accounts.destroy', $account->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Delete this account?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">Delete</button>
                            </form>
                            
                            
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center text-muted">No accounts found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mt-4 d-flex justify-content-center">
        {{ $accounts->links() }}
    </div>
</div>

@endsection

@push('styles')

    <link href="{{ asset('css/admin-save-accounts.css') }}" rel="stylesheet">
    <style>
/* admin-save-accounts.css */

/* Ensure the page takes full height and footer stays at the bottom */

h3.text-primary {
    font-size: 2.5rem; /* Bigger font size */
    font-weight: 800;  /* Bold weight */
    color: #1a1e24;   /* Primary color */
    text-transform: uppercase; /* Make text uppercase for a stronger effect */
    letter-spacing: 0.1em;  /* Slight letter spacing to make it more noticeable */
    margin-bottom: 2rem;  /* More space at the bottom */
    padding: 10px;  /* Add some padding to give more breathing room */
    text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1); /* Subtle shadow effect for depth */
    border-bottom: 4px solid #2f3135;  /* Bold underline for added emphasis */
}

html, body {
    height: 100%;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

/* Container for the table with padding and margin */
.table-container {
    flex: 1;
    background: linear-gradient(to right, #f8fbff, #eaf3ff);
    border-radius: 16px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    padding: 35px;
    margin: 30px auto;
    width: 95%;
    max-width: 1200px;
}

/* Table styling */
.table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 16px;
    font-size: 1rem;
    margin-bottom: 220px;
}

.table thead {
    background-color: #2b3238;
    color: #fff;
    font-weight: bold;
    text-transform: uppercase;
}

.table thead th {
    padding: 18px;
}

.table td, .table th {
    vertical-align: middle;
    border: none !important;
    padding: 16px 22px;
}

.table tbody tr {
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
    transition: transform 0.2s ease-in-out, background 0.2s;
}

.table tbody tr:hover {
    background-color: #dbe9ff;
    transform: translateY(-2px);
}

/* Buttons styling */
.btn {
    border-radius: 35px !important;
    padding: 10px 22px !important;
    font-weight: 600;
    font-size: 0.9rem;
    transition: all 0.2s ease-in-out;
}

.btn-outline-primary {
    border-color: #0d3b66;
    color: #0d3b66;
    margin: 5px;

}

.btn-outline-primary:hover {
    background-color: #0d3b66;
    color: #fff;
}

.btn-outline-danger {
    cursor: pointer;
    border-color: #b00020;
    color: #b00020;
    margin: 5px;
}

.btn-outline-danger:hover {
    background-color: #b00020;
    color: #fff;
}

.btn-outline-danger:focus {
    box-shadow: 0 0 0 0.25rem rgba(176, 0, 32, 0.5);
}

/* Badge styling */
.badge-method {
    background-color: #d6e4ff;
    color: #002766;
    padding: 6px 14px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 0.85rem;
}

/* Success alert styling */
.alert-success {
    border-left: 6px solid #198754;
    background-color: #d1e7dd;
    color: #0f5132;
    font-weight: 500;
    padding: 14px 20px;
    border-radius: 10px;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .table {
        font-size: 0.9rem;
    }

    .btn {
        padding: 8px 16px !important;
        font-size: 0.85rem;
    }

    .table thead {
        font-size: 0.85rem;
    }

    .table-container {
        padding: 20px;
        margin: 20px auto;
    }
}
   </style>
        
@endpush

