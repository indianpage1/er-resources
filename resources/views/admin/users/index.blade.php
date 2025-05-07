@extends('layoutss.admin.master')

@section('title', 'Manage Users')

@section('content')
<div class="container user-container my-5">

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif



  <div class="table-responsive fancy-table-wrapper">
    <table class="table fancy-table text-center align-middle">
      <thead>
        <tr>
          <th>#</th><th>Name</th><th>Email</th><th>City</th>
          <th>Referral Code</th><th>Referrer ID</th>
          <th>Ref Wallet</th><th>Main Wallet</th>
          <th>Total Refs</th><th>Plan ID</th>
          <th>Created</th><th>Updated</th><th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $u)
          <tr>
            <td>{{ $u->id }}</td>
            <td>{{ $u->name }}</td>
            <td>{{ $u->email }}</td>
            <td>{{ $u->city }}</td>
            <td>{{ $u->referral_code }}</td>
            <td>{{ $u->referrer_id }}</td>
            <td>${{ number_format($u->referral_wallet, 2) }}</td>
            <td>${{ number_format($u->main_wallet, 2) }}</td> 
            <td>{{ $u->total_referred_users }}</td>
                <td>{{ $u->userPlans->pluck('plan_id')->implode(', ') }}</td>
            <td>{{ $u->created_at->format('Y-m-d') }}</td>
            <td>{{ $u->updated_at->format('Y-m-d') }}</td>
            <td>
              <form method="POST" action="{{ route('users.destroy', $u) }}" class="d-inline-block">
                @csrf @method('DELETE')
                <button class="btn btn-danger btn-sm fw-semibold" onclick="return confirm('Delete this user?')">Delete</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <div class="mt-4 d-flex justify-content-center">
      {{ $users->links() }}
    </div>
  </div>
</div>

<style>
  .user-container {
    background: #fff;
    padding: 40px 30px;
    border-radius: 16px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);
    min-height: 80vh;
  }

  .custom-add-user-btn {
    background: linear-gradient(135deg, #4b5453, #1c2b23);
    color: #fff;
    padding: 12px 24px;
    font-weight: 600;
    font-size: 15px;
    border: none;
    border-radius: 10px;
    text-decoration: none;
    box-shadow: 0 6px 14px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease;
  }

  .custom-add-user-btn:hover {
    background: linear-gradient(135deg, #343d3c, #0f1a14);
    transform: translateY(-2px);
    color: #fff;
  }

  .fancy-table-wrapper {
    background: #fafafa;
    padding: 20px;
    border-radius: 14px;
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.04);
    overflow-x: auto;
  }

  .fancy-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
  }

  .fancy-table thead {
    background: #343a40;
    color: white;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  .fancy-table th, .fancy-table td {
    padding: 14px;
    border: 1px solid #dee2e6;
    font-weight: 500;
  }

  .fancy-table tbody tr:nth-child(even) {
    background-color: #f5f5f5;
  }

  .fancy-table tbody tr:hover {
    background-color: #eaeaea;
    transition: background-color 0.3s ease;
  }

  .btn-sm {
    padding: 6px 14px;
    font-size: 13px;
  }

  .btn-danger {
    background-color: #dc3545;
    border: none;
    color: white;
    border-radius: 8px;
    box-shadow: 0 2px 6px rgba(220, 53, 69, 0.4);
    transition: all 0.3s ease-in-out;
  }

  .btn-danger:hover {
    background-color: #b02a37;
    transform: translateY(-2px);
  }

  @media (max-width: 768px) {
    .custom-add-user-btn {
      width: 100%;
      text-align: center;
      margin-bottom: 20px;
    }

    .fancy-table th, .fancy-table td {
      padding: 10px;
      font-size: 12px;
    }

    .btn-sm {
      font-size: 12px;
      padding: 5px 10px;
    }
  }

  @media (max-width: 480px) {
    .fancy-table-wrapper {
      padding: 12px;
    }

    .fancy-table {
      font-size: 11px;
    }
  }
</style>
@endsection
