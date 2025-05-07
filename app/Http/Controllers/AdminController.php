<?php

namespace App\Http\Controllers;

use App\Models\DashboardData;
use App\Models\User;
use App\Models\WithdrawalRequest;
use App\Models\UserPlan; // Import UserPlan model
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();

        $totalWithdrawals = WithdrawalRequest::where('status', 'approved')
            ->sum('withdrawal_amount');
    
        $totalInvestment = UserPlan::sum('amount_invested'); // ← This is key
    
        $totalReferralUsers = User::sum('total_referred_users');
           
        $dashboardData = DashboardData::firstOrCreate([], [
            'total_withdrawals' => $totalWithdrawals,
            'total_investment' => $totalInvestment,
            'total_users' => $totalUsers,
            'referral_users' => $totalReferralUsers,
        ]);
    

        // Return the data to the view
        return view('admin.dashboard', [
            'dashboardData' => $dashboardData,
            'totalUsers' => $totalUsers,
            'totalWithdrawals' => $totalWithdrawals,
            'totalInvestment' => $totalInvestment,
            'totalReferralUsers' => $totalReferralUsers,
        ]);
    }
}
