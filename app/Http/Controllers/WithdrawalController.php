<?php
namespace App\Http\Controllers;

use App\Models\InvestmentPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserPlan;
use App\Models\Plan;
use App\Models\WithdrawalRequest;
use App\Models\SaveWithdrawlAccount;
use Illuminate\Support\Facades\DB;

class WithdrawalController extends Controller
{
    public function showWithdrawalForm()
    {
        
        $user = Auth::user();
        $currentBalance = $user->main_wallet;
    
        // Get all plan_ids purchased by the user
        $planIds = UserPlan::where('user_id', $user->id)->pluck('plan_id');
    
        // Fetch the actual plan records for those IDs
        $userPlans = InvestmentPlan::whereIn('id', $planIds)->get();
    
        // Get all saved withdrawal accounts for the logged-in user
        $accounts = SaveWithdrawlAccount::where('user_id', $user->id)->get();
        $latestWithdrawal = WithdrawalRequest::where('user_id', $user->id)
        ->latest()
        ->first();
        $withdrawals = WithdrawalRequest::where('user_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->get();
    
        return view('withdrawal', compact('currentBalance', 'userPlans', 'accounts', 'latestWithdrawal', 'withdrawals'));
    
    }
    
    public function processWithdrawal(Request $request)
    {
        $user = Auth::user();
    
        // ✅ Block if user has a pending request
        $pendingRequest = WithdrawalRequest::where('user_id', $user->id)
            ->where('status', 'pending')
            ->first();
    
        if ($pendingRequest) {
            return redirect()->route('withdrawal.form')
                ->with('error', 'You already have a pending request. Please wait for admin to respond.');
        }
    
        // ✅ Get last approved withdrawal
        $lastAccepted = WithdrawalRequest::where('user_id', $user->id)
            ->where('status', 'approved')
            ->latest()
            ->first();
    
        if ($lastAccepted) {
            $nextAllowedTime = $lastAccepted->created_at->addHours(24);
    
            if (now()->lessThan($nextAllowedTime)) {
                return redirect()->route('withdrawal.form')
                    ->with('error', 'You can only make one withdrawal every 24 hours. Try again after ' . $nextAllowedTime->diffForHumans() . '.');
            }
        }
    
        // ✅ Validate form
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'account_holder_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:20',
            'payment_method' => 'required|string|max:50',
        ]);
    
        // ✅ Check balance
        if ($request->amount > $user->main_wallet) {
            return redirect()->route('withdrawal.form')
                ->with('error', 'Insufficient balance. Please try again with a lower amount.');
        }
    
        // ✅ Store new withdrawal
        DB::beginTransaction();
    
        try {
            $userPlan = UserPlan::where('user_id', $user->id)->first();
    
            WithdrawalRequest::create([
                'user_id' => $user->id,
                'plan_id' => $userPlan ? $userPlan->id : null,
                'withdrawal_amount' => $request->amount,
                'account_name' => $request->account_holder_name,
                'account_number' => $request->account_number,
                'payment_method' => $request->payment_method,
                'status' => 'pending',
                'user_main_wallet' => $user->main_wallet,
            ]);
    
            DB::commit();
    
            return redirect()->route('withdrawal.form')->with('success', 'Your withdrawal request has been submitted and is pending admin review.');
    
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('withdrawal.form')->with('error', 'Something went wrong. Please try again later.');
        }
    }
    
    
    public function saveWithdrawalAccount(Request $request)
    {
        // Validation
        $request->validate([
            'account_holder_name' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:20',
            'method' => 'required|in:JazzCash,EasyPaisa',
        ]);

        // Save withdrawal account
        SaveWithdrawlAccount::create([
            'user_id' => Auth::id(),
            'account_holder_name' => $request->account_holder_name,
            'mobile_number' => $request->mobile_number,
            'method' => $request->method,
        ]);

        return back()->with('success', 'Withdrawal account saved successfully!');
    }
    public function getLatestStatus()
{
    $latestWithdrawal = WithdrawalRequest::where('user_id', Auth::id())
        ->latest()
        ->first();

    return response()->json([
        'status' => $latestWithdrawal->status ?? null,
        'message' => match($latestWithdrawal->status) {
            'pending' => 'Please wait 1 hour. Your withdrawal is in process. Decision pending.',
            'rejected' => 'Check and add another account. Your account was invalid.',
            'accepted' => 'Your withdrawal amount was successful. Enjoy!',
            default => null,
        },
    ]);
}

}
