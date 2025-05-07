<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserPlan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class RewardController extends Controller
{
    public function index()
    {
        //  Retrieve the authenticated user
        $user = auth()->user();
        $userPlans = UserPlan::where('user_id', $user->id)->get();

        // Evaluate if each plan can be claimed (24-hour cooldown)
        foreach ($userPlans as $plan) {
            $lastClaimed = $plan->last_claimed;
            $nextClaimAt = $lastClaimed ? Carbon::parse($lastClaimed)->addHours(24) : now()->subMinute();

            $plan->can_claim = now()->gte($nextClaimAt);
            $plan->next_claim_time = $nextClaimAt->toIso8601String(); // Send to frontend as ISO string
        }


        return view('reward.index', compact('userPlans'));
    }
    public function claimReward($planId)
    {
        try {
            Log::info('Reached claimReward method', ['plan_id' => $planId]);
    
            $user = auth()->user();
    
            if (!$user) {
                Log::error('User not authenticated.');
                return redirect()->route('reward.index')->with('error', 'User not authenticated.');
            }
    
            Log::info('Authenticated user', ['user_id' => $user->id]);
    
            $plan = UserPlan::where('user_id', $user->id)->where('plan_id', $planId)->first();
    
            if (!$plan) {
                Log::warning('Plan not found for claim', ['user_id' => $user->id, 'plan_id' => $planId]);
                return redirect()->route('reward.index')->with('error', 'Plan not found.');
            }
    
            // Check if the last claim was less than 2 minutes ago
            $lastClaimed = $plan->last_claimed;
            $diffMinutes = $lastClaimed ? Carbon::parse($lastClaimed)->diffInMinutes(now()) : 999;
    
            Log::info('Last claimed check', [
                'last_claimed' => $lastClaimed,
                'diff_minutes' => $diffMinutes
            ]);
    
            // Block the claim if the last claim was less than 2 minutes ago
            if ($lastClaimed && $diffMinutes < 2) {
                Log::info('Claim blocked due to cooldown', ['minutes_since_last_claim' => $diffMinutes]);
                return redirect()->route('reward.index')->with('error', 'You can claim your reward again in ' . (2 - $diffMinutes) . ' minutes.');
            }
    
            // Process the reward claim
            $plan->total_earning += $plan->daily_earning;
            $plan->last_claimed = now();
            $plan->save();
    
            // Update user's main_wallet
            $user->main_wallet = $user->referral_wallet + $user->userPlans->sum('total_earning');
            $user->save();
    
            Log::info('Reward claimed successfully', ['plan_id' => $plan->plan_id]);
    
            return redirect()->route('reward.index')->with('success', "Successfully claimed {$plan->daily_earning} coins!");
        } catch (\Exception $e) {
            Log::error('Error in claimReward: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('reward.index')->with('error', 'Something went wrong. Please try again.');
        }
    }
    
    
}
