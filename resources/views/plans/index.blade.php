@extends('layoutss.admin.master')

@section('title', 'Plans')

@section('content')
<div class="container-fluid py-5 px-3 px-md-5 bg-light">

    <div class="row">
        <div class="col-12 text-end mt-3 mb-4">
            <a href="{{ route('plans.create') }}" class="btn-add-plan">
                <i class="fas fa-plus-circle me-2"></i> Add New Plan
            </a>
        </div>
    </div>

    <div class="card shadow-lg border-0 rounded-4 p-4 mb-5">
        <div class="table-responsive">
            <table class="table modern-table w-100">
                <thead>
                    <tr>
                        <th>Plan Name</th>
                        <th>Amount</th>
                        <th>Daily Return</th>
                        <th>Withdrawal Limit</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($plans as $plan)
                        <tr>
                            <td>{{ $plan->plan_name }}</td>
                            <td>${{ number_format($plan->amount, 2) }}</td>
                            <td>${{ $plan->daily_return }}</td>
                            <td>${{ number_format($plan->withdrawal_limit, 2) }}</td>
                            <td>{{ optional($plan->created_at)->format('Y-m-d') ?? 'N/A' }}</td>
                            <td>{{ optional($plan->updated_at)->format('Y-m-d') ?? 'N/A' }}</td>
                            <td class="text-center d-flex justify-content-center gap-2 flex-wrap">
                                <a href="{{ route('plans.edit', $plan->id) }}" class="btn-custom edit">Edit</a>
                                <form action="{{ route('plans.destroy', $plan->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-custom delete" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
.manage-plan {
    margin-bottom: 30px;
    display: inline-block;
    text-align: center;
    margin: 20px auto;
    font-size: 28px;
    font-weight: 700;
    color: #333;
}

    /* Layout */
    .container-fluid {
        background-color: #f7f9fc;
        min-height: 100vh;
        margin-top: 40px;
    }
    
    /* Button */
    .btn-add-plan {
        background: linear-gradient(135deg, #44484d, #1b1e21);
        color: #fff;
        padding: 12px 26px;
        font-weight: 600;
        font-size: 15px;
        border-radius: 16px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        transition: all 0.3s ease;
        text-decoration: none;
        white-space: nowrap;
    }
    
    .btn-add-plan:hover {
        background: linear-gradient(135deg, #2d3033, #121416);
        transform: translateY(-2px);
    }
    
    /* Table Styling */
    .table-responsive {
        width: 100%;
        overflow-x: auto;
    }
    
    .modern-table {
        border-collapse: separate;
        border-spacing: 0 12px;
        width: 100%;
        font-size: 15px;
        min-width: 800px;
    }
    
    .modern-table th {
        background-color: #212529;
        color: #fff;
        padding: 16px;
        border: none;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        font-weight: 700;
        white-space: nowrap;
    }
    
    .modern-table td {
        background: #fff;
        padding: 16px;
        border-top: 1px solid #eee;
        border-bottom: 1px solid #eee;
        font-weight: 500;
        white-space: nowrap;
    }
    
    .modern-table tbody tr:hover td {
        background-color: #eef1f5;
        transition: 0.3s ease;
    }
    
    /* Action Buttons */
    .btn-custom {
        padding: 8px 16px;
        font-size: 14px;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        transition: 0.3s ease;
        min-width: 90px;
        text-align: center;
        white-space: nowrap;
    }
    
    .btn-custom.edit {
        background-color: #ffc107;
        color: #000;
    }
    
    .btn-custom.edit:hover {
        background-color: #e0a800;
    }
    
    .btn-custom.delete {
        background-color: #dc3545;
        color: #fff;
    }
    
    .btn-custom.delete:hover {
        background-color: #b02a37;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .modern-table th, .modern-table td {
            font-size: 13px;
            padding: 10px;
        }
    
        .btn-custom {
            width: 100%;
            margin-bottom: 6px;
        }
    
        .d-flex.gap-2 {
            flex-direction: column !important;
            align-items: stretch;
        }
    
        .btn-add-plan {
            width: 100%;
            display: inline-block;
            text-align: center;
        }
    }
    </style>
    
@endsection
