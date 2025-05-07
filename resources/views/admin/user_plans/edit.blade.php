@extends('layoutss.admin.master')

@section('content')
<style>
    /* General Form Styling */
    .container {
        max-width: 1000px;
        margin: auto;
        padding: 20px;
    }

    .form-container {
        background: #f9f9f9;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    h1 {
        font-size: 24px;
        margin-bottom: 20px;
        color: #333;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-control {
        padding: 15px;
        border-radius: 8px;
        border: 1px solid #ddd;
        width: 100%;
        box-sizing: border-box;
        font-size: 16px;
        color: #333;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    label {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 10px;
        display: block;
        color: #444;
    }

    .btn {
        padding: 12px 20px;
        font-size: 16px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
    }

    .btn-success {
        background-color: #28a745;
        color: #fff;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .btn-secondary {
        background-color: #6c757d;
        color: #fff;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    .btn-back {
        margin-left: 10px;
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
        .form-container {
            padding: 20px;
        }

        h1 {
            font-size: 20px;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-control {
            padding: 12px;
            font-size: 14px;
        }

        .btn {
            padding: 10px 15px;
            font-size: 14px;
        }
    }

</style>

<div class="container py-4">
    <div class="form-container">
        <h1>Edit User Plan #{{ $userPlan->id }}</h1>

        <form action="{{ route('admin.user_plans.update', $userPlan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="user_id">User</label>
                <select name="user_id" class="form-control" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $userPlan->user_id == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="plan_id">Plan</label>
                <select name="plan_id" class="form-control" required>
                    @foreach($plans as $plan)
                        <option value="{{ $plan->id }}" {{ $userPlan->plan_id == $plan->id ? 'selected' : '' }}>
                            {{ $plan->plan_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            

            <div class="form-group">
                <label for="daily_earning">Daily Earning</label>
                <input type="number" step="0.01" name="daily_earning" value="{{ $userPlan->daily_earning }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="daily_earning_with_increment">Daily Earning With Increment</label>
                <input type="number" step="0.01" name="daily_earning_with_increment" value="{{ $userPlan->daily_earning_with_increment }}" class="form-control" required>
            </div>

            <button class="btn btn-success" type="submit">Update</button>
            <a href="{{ route('admin.user_plans.index') }}" class="btn btn-secondary btn-back">Back</a>
        </form>
    </div>
</div>
@endsection
