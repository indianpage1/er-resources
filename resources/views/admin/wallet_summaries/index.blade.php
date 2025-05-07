@extends('layoutss.admin.master')


@section('content')
<div class="container mt-5">
    <h2 class="mb-4">User Wallet Summaries</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>User Name</th>
                <th>Total Earning</th>
                <th>Total Withdrawal</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($summaries as $summary)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $summary->user->name ?? 'N/A' }}</td>
                    <td>PKR {{ number_format($summary->total_earning, 2) }}</td>
                    <td>PKR {{ number_format($summary->total_withdrawal, 2) }}</td>
                    <td>
                        <a href="{{ route('admin.wallet_summaries.edit', $summary->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.wallet_summaries.delete', $summary->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>


<style>
        
/* General styles */
/* General styles */
body {
    font-family: 'Arial', sans-serif;
    background-color: #eeeeee;
    color: #333;
}

.container {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
}

h2 {
    color: #333;
    font-size: 24px;
    font-weight: 700;
    text-align: center;
    margin-bottom: 20px;
}

.alert {
    border-radius: 5px;
    font-size: 14px;
    text-align: center;
}

.alert-success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

/* Table container */
.table-responsive {
    width: 100%;
    overflow-x: auto;
}

/* Table styles */
.table {
    width: 100%;
    border-collapse: collapse;
}

.table-bordered {
    border: 1px solid #dee2e6;
}

.table-striped tbody tr:nth-child(odd) {
    background-color: #f9f9f9;
}

.table-hover tbody tr:hover {
    background-color: #f1f1f1;
}

.table-dark {
    background-color: #343a40;
    color: #fff;
    font-weight: bold;
}

th, td {
    padding: 12px 15px;
    text-align: left;
    font-size: 14px;
}

th {
    background-color: #343a40;
    color: #fff;
}

/* Button styles */
.btn {
    padding: 6px 12px;
    font-size: 14px;
    border-radius: 5px;
    text-decoration: none;
    display: inline-block;
    white-space: nowrap;
}

.btn-sm {
    padding: 4px 8px;
    font-size: 12px;
}

.btn-warning {
    background-color: #ffc107;
    color: #212529;
    border: 1px solid #ffc107;
}

.btn-warning:hover {
    background-color: #e0a800;
    color: #fff;
}

.btn-danger {
    cursor: pointer;
    background-color: #dc3545;
    color: #fff;
    border: 1px solid #dc3545;
}

.btn-danger:hover {
    background-color: #c82333;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    th, td {
        font-size: 12px;
        padding: 8px 10px;
    }

    .btn {
        font-size: 12px;
        padding: 5px 10px;
    }

    .btn-sm {
        font-size: 11px;
        padding: 4px 6px;
    }

    td .btn {
        display: block;
        width: 100%;
        margin-bottom: 5px;
    }

    td form {
        display: block;
        width: 100%;
    }
}


</style>
@endsection