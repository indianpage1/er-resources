<?php

namespace App\Http\Controllers;

use App\Models\WithdrawalRequest;
use Illuminate\Http\Request;

class AdminWithdrawalController extends Controller
{
    // Show all withdrawal requests
    public function index()
    {
        $withdrawals = WithdrawalRequest::all(); // Get all withdrawal requests
        return view('admin.withdrawals.index', compact('withdrawals'));
    }

    // Update status of a withdrawal request
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);
    
        $withdrawal = WithdrawalRequest::findOrFail($id);
    
        // Only process deduction if changing to approved
        if ($withdrawal->status !== 'approved' && $request->status === 'approved') {
            $user = $withdrawal->user;
    
            if ($user->main_wallet >= $withdrawal->withdrawal_amount) {
                // Deduct from main_wallet
                $user->main_wallet -= $withdrawal->withdrawal_amount;
                $user->save();
    
                // NEW: Deduct from total_earning across user's plans
                $remaining = $withdrawal->withdrawal_amount;
                $plans = $user->userPlans()->orderBy('total_earning', 'desc')->get(); // Most earned plans first
    
                foreach ($plans as $plan) {
                    if ($remaining <= 0) break;
    
                    if ($plan->total_earning >= $remaining) {
                        $plan->total_earning -= $remaining;
                        $plan->save();
                        $remaining = 0;
                    } else {
                        $remaining -= $plan->total_earning;
                        $plan->total_earning = 0;
                        $plan->save();
                        
                    }
                }
    
                $withdrawal->status = 'approved';
                $withdrawal->save();
    
                $summary = \App\Models\UserWalletSummary::firstOrCreate(['user_id' => $user->id]);
                $summary->total_withdrawal += $withdrawal->withdrawal_amount;
                $summary->save();
                
                return back()->with('success', 'Withdrawal approved and balances updated.');
            } else {
                return back()->with('error', 'Insufficient wallet balance.');
            }
        }
    
        // Handle non-approved statuses
        $withdrawal->status = $request->status;
        $withdrawal->save();
    
        return back()->with('success', 'Withdrawal status updated.');
    }
    
    

    // Delete a withdrawal request
    public function destroy($id)
    {
        $withdrawal = WithdrawalRequest::findOrFail($id);
        $withdrawal->delete();

        return redirect()->route('admin.withdrawals.index')->with('success', 'Withdrawal request deleted successfully.');
    }
}
