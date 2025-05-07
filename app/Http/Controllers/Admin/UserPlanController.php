<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InvestmentPlan;
use Illuminate\Http\Request;
use App\Models\UserPlan;
use App\Models\User;

class UserPlanController extends Controller
{
    public function index()
    {
        $userPlans = UserPlan::with('user', 'plan')->latest()->get();
        return view('admin.user_plans.index', compact('userPlans'));
    }

    public function edit($id)
    {
        $userPlan = UserPlan::findOrFail($id);
        $users = User::all();
        $plans = InvestmentPlan::all(); // ✅ correct model
    
        return view('admin.user_plans.edit', compact('userPlan', 'users', 'plans'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'plan_id' => 'required|exists:investment_plans,id',
            'daily_earning' => 'required|numeric',
            'daily_earning_with_increment' => 'required|numeric',
        ]);
    
        $userPlan = UserPlan::findOrFail($id);
    
        $userPlan->user_id = $request->user_id;
        $userPlan->plan_id = $request->plan_id;
        $userPlan->daily_earning = $request->daily_earning;
        $userPlan->daily_earning_with_increment = $request->daily_earning_with_increment;
    
        $userPlan->save(); // ✅ Required to persist changes
    
        return redirect()->route('admin.user_plans.index')->with('success', 'User Plan updated successfully.');
    }
    
    public function destroy($id)
    {
        $userPlan = UserPlan::findOrFail($id);
        $userPlan->delete();

        return redirect()->route('admin.user_plans.index')->with('success', 'User plan deleted successfully.');
    }
}
