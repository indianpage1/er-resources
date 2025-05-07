@extends('layoutss.admin.master')

@section('content')
<div class="container mt-5">
    <h3 class="mb-4 text-center">User Transactions</h3>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Plan ID</th>
                    <th>User Name</th>
                    <th>Plan Name</th>
                    <th>Plan Amount</th>
                    <th>Payment Screenshot</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $txn)
                    <tr>
                        <td>{{ $txn->id }}</td>
                        <td>{{ $txn->user_id }}</td>
                        <td>{{ $txn->plan_id }}</td>
                        <td>{{ $txn->user_name }}</td>
                        <td>{{ $txn->plan_Name ?? 'N/A' }}</td>
                        <td>${{ number_format($txn->plan_amount, 2) }}</td>
                        <td>
                            <a href="{{ route('admin.transactions.showImage', $txn->id) }}" class="btn btn-info btn-sm">View</a>
                        </td>
                        <td>{{ $txn->created_at ? $txn->created_at->format('Y-m-d H:i') : '-' }}</td>
                        <td>{{ $txn->updated_at ? $txn->updated_at->format('Y-m-d H:i') : '-' }}</td>
                        <td>
                            <form action="{{ route('admin.transactions.updateStatus', $txn->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="status" class="form-control status-dropdown" onchange="this.form.submit()">
                                    <option value="pending" {{ $txn->status == 'pending' ? 'selected' : '' }} style="background-color: yellow;">Pending</option>
                                    <option value="accepted" {{ $txn->status == 'accepted' ? 'selected' : '' }} style="background-color: green; color: white;">Accepted</option>
                                    <option value="rejected" {{ $txn->status == 'rejected' ? 'selected' : '' }} style="background-color: red; color: white;">Rejected</option>
                                </select>
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('admin.transactions.edit', $txn->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <a href="{{ route('admin.transactions.show', $txn->id) }}" class="btn btn-sm btn-info">View</a>
                            <form action="{{ route('admin.transactions.destroy', $txn->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete this transaction?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<style>
/* General Styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
}

.container {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
}

/* Header Styling */
h3 {
    font-size: 30px;
    color: #333;
    font-weight: 600;
    margin-bottom: 20px;
    text-align: center;
}

/* Table Styling */
table {
    width: 100%;
    margin-bottom: 30px;
    border-collapse: collapse;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

thead {
    background-color: #007bff;
    color: #fff;
}

th {
    padding: 12px;
    text-align: left;
    font-weight: bold;
    text-transform: uppercase;
}

td {
    padding: 12px;
    color: #333;
}

tbody tr:hover {
    background-color: #f1f1f1;
}

/* Status Dropdown Styling */
.status-dropdown {
    width: 150px;
    font-size: 1rem;
    padding: 0.5rem;
    border-radius: 8px;
}

.status-dropdown option {
    padding: 10px;
    font-weight: bold;
}

/* Button Styling */
.btn {
    padding: 6px 12px;
    font-size: 14px;
    border-radius: 4px;
    text-align: center;
    display: inline-block;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-warning {
    background-color: #ffc107;
    color: #fff;
}

.btn-warning:hover {
    background-color: #e0a800;
}

.btn-info {
    background-color: #17a2b8;
    color: #fff;
}

.btn-info:hover {
    background-color: #138496;
}

.btn-danger {
    background-color: #dc3545;
    color: #fff;
}

.btn-danger:hover {
    background-color: #c82333;
}

/* Responsive Styles */
@media (max-width: 1200px) {
    table {
        font-size: 14px;
    }

    th, td {
        padding: 8px;
    }

    .btn {
        font-size: 12px;
        padding: 4px 8px;
    }

    .status-dropdown {
        width: 120px;
        font-size: 0.9rem;
    }
}

/* For smaller screens */
@media (max-width: 768px) {
    table {
        font-size: 12px;
        overflow-x: auto;
        margin-left: 0;
        margin-right: 0;
        display: block;
    }

    th, td {
        padding: 8px;
        font-size: 12px;
    }

    .status-dropdown {
        font-size: 0.9rem;
        width: 100px;
    }

    .btn {
        font-size: 12px;
        padding: 4px 8px;
    }

    /* Stack actions for small screens */
    td {
        display: block;
        padding: 10px;
    }

    td a,
    td button {
        margin-bottom: 5px;
    }
}

/* For even smaller screens (Mobile) */
@media (max-width: 576px) {
    h3 {
        font-size: 22px;
    }

    table {
        font-size: 10px;
        overflow-x: auto;
        display: block;
        width: 100%;
    }

    th, td {
        padding: 6px;
        font-size: 10px;
    }

    .status-dropdown {
        width: 80px;
        font-size: 0.8rem;
    }

    .btn {
        font-size: 10px;
        padding: 4px 6px;
    }

    td a,
    td button {
        font-size: 10px;
        padding: 3px 6px;
    }
}
</style>

@endsection
