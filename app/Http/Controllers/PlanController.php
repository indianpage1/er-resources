<?php

namespace App\Http\Controllers;

use App\Models\InvestmentPlan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        $plans = InvestmentPlan::all();
        return view('plans.index', compact('plans'));
    }

    // Show the form for creating a new resource
    public function create()
    {
        return view('plans.create');
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        $request->validate([
            'plan_name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'daily_return' => 'required|numeric',
            'withdrawal_limit' => 'required|numeric',
        ]);

        InvestmentPlan::create($request->all());

        return redirect()->route('plans.index')->with('success', 'Plan created successfully.');
    }

    // Display the specified resource
    public function show(InvestmentPlan $plan)
    {
        return view('plans.show', compact('plan'));
    }

    // Show the form for editing the specified resource
    public function edit(InvestmentPlan $plan)
    {
        return view('plans.edit', compact('plan'));
    }

    // Update the specified resource in storage
    public function update(Request $request, InvestmentPlan $plan)
    {
        $plan->update([
            'plan_name' => $request->input('plan_name'),
            'amount' => $request->input('amount'),
            'daily_return' => $request->input('daily_return'),
            'withdrawal_limit' => $request->input('withdrawal_limit'),
            'updated_at' => now(),
        ]);
        
        $plan->update($request->all());

        return redirect()->route('plans.index')->with('success', 'Plan updated successfully.');
    }

    // Remove the specified resource from storage
    public function destroy(InvestmentPlan $plan)
    {
        $plan->delete();

        return redirect()->route('plans.index')->with('success', 'Plan deleted successfully.');
    }
}
