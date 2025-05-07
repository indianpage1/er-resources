@extends('layoutss.admin.master')

@section('title', isset($plan) ? 'Edit Plan' : 'Create Plan')

@section('content')
    <div class="heavy-form">
        <h3 class="form-title">
            {{ isset($plan) ? '✏️ Edit Plan' : '➕ Create New Plan' }}
        </h3>

        <form action="{{ isset($plan) ? route('plans.update', $plan->id) : route('plans.store') }}" method="POST">
            @csrf
            @if(isset($plan))
                @method('PUT')
            @endif

            <div class="form-group mb-4">
                <label for="plan_name" class="form-label">📌 Plan Name</label>
                <input type="text" name="plan_name" class="form-control input-heavy"
                       value="{{ old('plan_name', $plan->plan_name ?? '') }}" required>
            </div>

            <div class="form-group mb-4">
                <label for="amount" class="form-label">💰 Amount ($)</label>
                <input type="number" name="amount" class="form-control input-heavy"
                       value="{{ old('amount', $plan->amount ?? '') }}" step="0.01" required>
            </div>

            <div class="form-group mb-4">
                <label for="daily_return" class="form-label">📈 Daily Return (%)</label>
                <input type="number" name="daily_return" class="form-control input-heavy"
                       value="{{ old('daily_return', $plan->daily_return ?? '') }}" step="0.01" required>
            </div>

            <div class="form-group mb-5">
                <label for="withdrawal_limit" class="form-label">🚪 Withdrawal Limit ($)</label>
                <input type="number" name="withdrawal_limit" class="form-control input-heavy"
                       value="{{ old('withdrawal_limit', $plan->withdrawal_limit ?? '') }}" step="0.01" required>
            </div>

            <button type="submit" class="btn heavy-submit">
                {{ isset($plan) ? '💾 Update Plan' : '💾 Save Plan' }}
            </button>
        </form>
    </div>

    <style>
        .heavy-form {
            max-width: 650px;
            width: 90%;
            margin: 50px auto;
            padding: 40px;
            border-radius: 16px;
            background: linear-gradient(145deg, #f8f8f8, #ffffff);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(3px);
            border: 1px solid #eee;
            box-sizing: border-box;
        }
    
        .form-title {
            font-weight: 700;
            font-size: 26px;
            color: #2e2e2e;
            margin-bottom: 30px;
            text-align: center;
        }
    
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
    
        .form-label {
            font-size: 15px;
            font-weight: 600;
            color: #333;
        }
    
        .input-heavy {
            background-color: #f4f4f4;
            border: 2px solid #ccc;
            height: 55px;
            border-radius: 10px;
            padding: 12px 18px;
            font-size: 16px;
            transition: all 0.3s ease-in-out;
            box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.05);
            width: 100%;
            box-sizing: border-box;
        }
    
        .input-heavy:focus {
            border-color: #2e7d32;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(46, 125, 50, 0.2);
            outline: none;
        }
    
        .heavy-submit {
            width: 100%;
            background: linear-gradient(135deg, #3d463d, #8c9e8d);
            padding: 16px;
            font-size: 17px;
            font-weight: 700;
            color: #fff;
            border: none;
            border-radius: 10px;
            margin-top: 46px;
            box-shadow: 0 10px 25px rgb(79, 87, 79);
            transition: all 0.3s ease;
            cursor: pointer;
        }
    
        .heavy-submit:hover {
            background: linear-gradient(135deg, #1f201f, #636d64);
            box-shadow: 0 15px 30px rgb(60, 61, 60);
            transform: translateY(-2px);
        }
    
        @media (max-width: 768px) {
            .heavy-form {
                padding: 30px 20px;
            }
    
            .form-title {
                font-size: 22px;
            }
    
            .input-heavy {
                height: 50px;
                font-size: 15px;
            }
    
            .heavy-submit {
                padding: 14px;
                font-size: 16px;
            }
        }
    
        @media (max-width: 480px) {
            .form-title {
                font-size: 20px;
            }
    
            .input-heavy {
                height: 48px;
                padding: 10px 14px;
                font-size: 14px;
            }
    
            .heavy-submit {
                font-size: 15px;
                padding: 12px;
            }
        }
    </style>
    
@endsection
