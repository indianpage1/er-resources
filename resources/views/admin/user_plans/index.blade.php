@extends('layoutss.admin.master')

@section('content')
<style>
    .table-responsive {
        overflow-x: auto;
    }

    .user-plan-table {
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
        background-color: #ffffff;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
        border-radius: 12px;
        overflow: hidden;
    }

    .user-plan-table thead {
        background-color: #343a40;
        color: #ffffff;
    }

    .user-plan-table th,
    .user-plan-table td {
        padding: 14px 16px;
        vertical-align: middle;
        text-align: center;
        border-bottom: 1px solid #dee2e6;
    }

    .user-plan-table tbody tr:hover {
        background-color: #f8f9fa;
    }

    .btn-sm {
        padding: 6px 10px;
        font-size: 0.85rem;
        border-radius: 6px;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
    }

    .btn-danger {
        background-color: #dc3545;
        border: none;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-danger:hover {
        background-color: #b02a37;
    }

    @media screen and (max-width: 768px) {
        .user-plan-table thead {
            display: none;
        }

        .user-plan-table, .user-plan-table tbody, .user-plan-table tr, .user-plan-table td {
            display: block;
            width: 100%;
        }

        .user-plan-table tr {
            margin-bottom: 15px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 10px;
            background-color: #fff;
        }

        .user-plan-table td {
            text-align: left;
            padding-left: 50%;
            position: relative;
        }

        .user-plan-table td::before {
            content: attr(data-label);
            position: absolute;
            left: 15px;
            font-weight: bold;
            color: #333;
        }
    }
</style>

<div class="container py-4">
    <h2 class="mb-4">📋 User Plans</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="user-plan-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Plan</th>
                    <th>Amount Invested</th>
                    <th>Daily Earning</th>
                    <th>Total Earning</th>
                    <th>Last Claimed</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
        
                
                @foreach($userPlans as $plan)
                    <tr>
                        <td data-label="ID">{{ $plan->id }}</td>
                        <td data-label="User">{{ $plan->user->name ?? 'N/A' }}</td>
                        <td data-label="Plan">
                            {{ $plan->plan->plan_name ?? $plan->plan_name ?? 'N/A' }}
                        </td>                        <td data-label="Amount Invested">{{ $plan->amount_invested }}</td>
                        <td data-label="Daily Earning">{{ $plan->daily_earning }}</td>
                        <td data-label="Total Earning">{{ $plan->total_earning }}</td>
                        <td data-label="Last Claimed">{{ $plan->last_claimed }}</td>
                        <td data-label="Created At">{{ $plan->created_at->format('Y-m-d') }}</td>
                        <td data-label="Actions">
                            <a href="{{ route('admin.user_plans.edit', $plan->id) }}" class="btn btn-sm btn-primary mb-1">Edit</a>

                            <form action="{{ route('admin.user_plans.destroy', $plan->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
