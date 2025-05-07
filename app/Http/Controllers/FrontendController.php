<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\UserPlan;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    /**
     * Show the calculator view (GET)
     */
    public function showCalculator()
    {
        return view('calculator');
    }


    public function home()
    {
        return view('home');
    }

    public function login()
    {
        return view('Auth.login');
    }

    public function register()
    {
        return view('Auth.register');
    }
    public function dashboard()
    {
        $user = Auth::user();
    
        // Fetch every plan this user has
        $activePlans = UserPlan::where('user_id', $user->id)->get();
    
        // Fetch user's wallet summary (or null if not created yet)
        $walletSummary = \App\Models\UserWalletSummary::where('user_id', $user->id)->first();
    
        $userPaymentStatus = $user->latestTransaction->status ?? 'pending';
    
        // 👇 NEW: Recent Activity Logic
        $investments = \App\Models\UserTransaction::where('user_id', $user->id)
            ->select('created_at', 'plan_amount as amount', 'status', 'id')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,  // Add ID for later reference in deletion
                    'date' => $item->created_at,
                    'type' => 'Invested',
                    'amount' => $item->amount,
                    'status' => ucfirst($item->status),
                ];
            });
    
        $withdrawals = \App\Models\WithdrawalRequest::where('user_id', $user->id)
            ->select('created_at', 'withdrawal_amount as amount', 'status', 'id')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,  // Add ID for later reference in deletion
                    'date' => $item->created_at,
                    'type' => 'Withdrawn',
                    'amount' => $item->amount,
                    'status' => ucfirst($item->status),
                ];
            });
    
        $referralActivities = [];
    
        if ($user->total_referred_users > 0) {
            for ($i = 0; $i < $user->total_referred_users; $i++) {
                $referralActivities[] = [
                    'id' => 'referral_'.$i, // Unique ID for each referral (could be static or dynamic)
                    'date' => now()->subDays($i + 1),
                    'type' => 'Referral Bonus',
                    'amount' => 200,
                    'status' => 'Completed',
                ];
            }
        }
    
        $activities = collect()
            ->merge($investments)
            ->merge($withdrawals)
            ->merge($referralActivities)
            ->sortByDesc('date')
            ->values();
    
        // Handling Deletion for Activity (Single Click)
        if (request()->has('delete_activity_id')) {
            $activityId = request('delete_activity_id');
            
            // Check if it's an investment or withdrawal and delete accordingly
            $investment = \App\Models\UserTransaction::where('id', $activityId)->first();
            if ($investment) {
                $investment->delete();
                return redirect()->route('dashboard')->with('message', 'Investment activity deleted successfully.');
            }
    
            $withdrawal = \App\Models\WithdrawalRequest::where('id', $activityId)->first();
            if ($withdrawal) {
                $withdrawal->delete();
                return redirect()->route('dashboard')->with('message', 'Withdrawal activity deleted successfully.');
            }
    
            // Handle deletion of referral (this is just conceptual as it may be dynamic)
            if (strpos($activityId, 'referral') !== false) {
                return redirect()->route('dashboard')->with('message', 'Referral activity cannot be deleted as it is dynamic.');
            }
    
            return redirect()->route('dashboard')->with('message', 'Activity not found.');
        }
    
        // Return view with all data
        return view('dashboard', compact('activePlans', 'userPaymentStatus', 'walletSummary', 'activities'));
    }
    

    public function withdraw()
    {
        return view('withdraw');
    }

    public function plans()
    {
        return view('plans');
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }
}
