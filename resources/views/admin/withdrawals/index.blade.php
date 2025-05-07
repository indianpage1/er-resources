@extends('layoutss.admin.master')

@section('content')
<div class="card-container">     
    <div class="card shadow-sm mb-5">
        <div class="card-body p-4">
            <h4 class="withdrawal-heading mb-4 fw-bold text-primary">Withdrawal Requests</h4>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User ID</th>
                        <th>Plan ID</th>
                        <th>Account Name</th>
                        <th>Account Number</th>
                        <th>Withdrawal Amount</th>
                        <th>Payment Method</th>
                        <th>Main Wallet</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($withdrawals as $withdrawal)
                        <tr>
                            <td data-label="ID">{{ $withdrawal->id }}</td>
                            <td data-label="User ID">{{ $withdrawal->user_id }}</td>
                            <td data-label="Plan ID">{{ $withdrawal->plan_id }}</td>
                            <td data-label="Account Name">{{ $withdrawal->account_name }}</td>
                            <td data-label="Account Number">{{ $withdrawal->account_number }}</td>
                            <td data-label="Amount">₨ {{ number_format($withdrawal->withdrawal_amount) }}</td>
                            <td data-label="Method">{{ $withdrawal->payment_method }}</td>
                            <td data-label="Main Wallet">₨ {{ number_format($withdrawal->user_main_wallet) }}</td>
                            <td>
                                <form action="{{ route('admin.withdrawals.updateStatus', $withdrawal->id) }}" method="POST">
                                    @csrf
                                    <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                        <option value="pending" {{ $withdrawal->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="approved" {{ $withdrawal->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="rejected" {{ $withdrawal->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('admin.withdrawals.destroy', $withdrawal->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this request?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>
</div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selects = document.querySelectorAll('select[name="status"]');
    
            selects.forEach(select => {
                setColor(select); // Initial color
                select.addEventListener('change', function () {
                    setColor(this);
                });
            });
    
            function setColor(select) {
                select.classList.remove('status-pending', 'status-approved', 'status-rejected');
    
                switch (select.value) {
                    case 'pending':
                        select.classList.add('status-pending');
                        break;
                    case 'approved':
                        select.classList.add('status-approved');
                        break;
                    case 'rejected':
                        select.classList.add('status-rejected');
                        break;
                }
            }
        });
    </script>
@endsection

@push('styles')
<style>
    .status-pending {
    background-color: #fff3cd !important;
    color: #856404 !important;
}

.status-approved {
    background-color: #d4edda !important;
    color: #155724 !important;
}

.status-rejected {
    background-color: #f8d7da !important;
    color: #721c24 !important;
}

    /* Base Card Styling */
    .withdrawal-heading {
        margin-top: 10px;
    font-size: 2rem;
    font-weight: 800;
    color: #252729;
    text-transform: uppercase;
    letter-spacing: 1px;
    position: relative;
    padding-left: 15px;
}



.withdrawal-heading:hover {
    text-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    transition: all 0.3s ease-in-out;
}

.card-container{
}

.card {
    
    border-radius: 20px;
    border: none;
    background: #fff;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    transition: all 0.3s ease-in-out;
}

.card:hover {
    transform: translateY(-2px);
}

/* Table Styling */
.table {
    
    margin-top: 20px;
    border-collapse: separate;
    border-spacing: 0;
    width: 100%;
    font-size: 0.95rem;
    background-color: #fff;
    box-shadow: 0 0 0 2px #e0e0e0 inset;
    border-radius: 15px;
    overflow: hidden;
}

.table thead {
    background: linear-gradient(to right, #007bff, #6610f2);
    color: white;
}

.table thead th {
    padding: 15px;
    font-weight: 700;
    text-transform: uppercase;
    font-size: 0.85rem;
    border-bottom: none;
    white-space: nowrap;
}

.table tbody tr {
    transition: all 0.2s;
    border-bottom: 1px solid #e6e6e6;
}

.table tbody tr:hover {
    background-color: #f8f9fa;
}

.table tbody td {
    padding: 14px 12px;
    vertical-align: middle;
    font-size: 0.94rem;
}

/* Status Badge Dropdown */
select.form-select-sm {
    cursor: pointer;

    background-color: #f1f3f5;
    border: 1px solid #ced4da;
    padding: 6px 10px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 0.85rem;
    color: #495057;
    transition: border-color 0.3s ease;
}

select.form-select-sm:focus {
    border-color: #80bdff;
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
}

/* Buttons */
.btn-sm {
    padding: 6px 14px;
    font-weight: bold;
    border-radius: 20px;
    transition: all 0.3s ease;
}

.btn-danger.btn-sm {
    cursor: pointer;
    background: linear-gradient(to right, #ff4e50, #f9d423);
    border: none;
    color: white;
}

.btn-danger.btn-sm:hover {
    background: linear-gradient(to right, #ff416c, #ff4b2b);
}

/* Responsive Table */
@media (max-width: 768px) {
    .table thead {
        display: none;
    }

    .table, .table tbody, .table tr, .table td {
        display: block;
        width: 100%;
    }

    .table tr {
        margin-bottom: 15px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        border-radius: 10px;
        overflow: hidden;
    }

    .table td {
        text-align: right;
        padding-left: 50%;
        position: relative;
    }

    .table td::before {
        content: attr(data-label);
        position: absolute;
        left: 15px;
        top: 14px;
        font-weight: bold;
        text-transform: uppercase;
        font-size: 0.75rem;
        color: #6c757d;
    }
}

</style>
    
@endpush