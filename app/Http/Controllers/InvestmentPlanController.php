<?php

namespace App\Http\Controllers;
use App\Models\UserPlan;

use Illuminate\Http\Request;
use App\Models\InvestmentPlan;

class InvestmentPlanController extends Controller
{
    // Store default investment plans in DB
    public function storePlans()
    {
        $plans = [
            ['plan_name' => 'Plan 1', 'amount' => 300, 'daily_return' => 40, 'withdrawal_limit' => 120],
            ['plan_name' => 'Plan 2', 'amount' => 1000, 'daily_return' => 120, 'withdrawal_limit' => 400],
            ['plan_name' => 'Plan 3', 'amount' => 3000, 'daily_return' => 360, 'withdrawal_limit' => 1200],
            ['plan_name' => 'Plan 4', 'amount' => 5000, 'daily_return' => 600, 'withdrawal_limit' => 2000],
            ['plan_name' => 'Plan 5', 'amount' => 10000, 'daily_return' => 1200, 'withdrawal_limit' => 4000],
            ['plan_name' => 'Plan 6', 'amount' => 20000, 'daily_return' => 2500, 'withdrawal_limit' => 8000],
            ['plan_name' => 'Plan 7', 'amount' => 50000, 'daily_return' => 6000, 'withdrawal_limit' => 15000],
        ];

        // Avoid duplicating records if already stored
        if (InvestmentPlan::count() == 0) {
            foreach ($plans as $plan) {
                InvestmentPlan::create($plan);
            }
            return response()->json(['message' => 'Investment plans saved successfully.']);
        }

        return response()->json(['message' => 'Investment plans already exist.']);
    }


    public function showPlans()
    {
        $plans = InvestmentPlan::all();
    
        $purchasedPlanIds = UserPlan::where('user_id', auth()->id())
                                    ->pluck('plan_id')
                                    ->toArray();
    
        return view('plans', compact('plans', 'purchasedPlanIds'));
    }
}
