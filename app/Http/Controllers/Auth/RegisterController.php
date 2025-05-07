<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserPlan;

use App\Models\UserWalletSummary; // ✅ ADD THIS
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function showForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'referral_code' => 'nullable|string|max:255',
        ]);

        // Create the new user
        $referralCode = Str::upper(Str::random(8));
        $user = new User();
        $user->name = $request->name;
        $user->city = $request->city;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->referral_code = $referralCode;
        $user->referral_wallet = 0;
        $user->main_wallet = 0;
        $user->plan_id = null;  // Make sure it's set to null if they haven't chosen a plan yet
        $user->total_referred_users = 0;

        // Handle referral code logic
        if ($request->referral_code) {
            $referralCodeInput = trim($request->referral_code);
            $referrer = User::where('referral_code', $referralCodeInput)->first();

            if ($referrer) {
                $referrer->referral_wallet += 200;
                $referrer->main_wallet += 200;
                $referrer->total_referred_users += 1;
                $referrer->save();

                $user->referrer_id = $referrer->id;
            } else {
                Log::info('Referral code not found: ' . $referralCodeInput);
            }
        }

        // Save the new user
        $user->save();

        // Now update the user's main_wallet and plan_id from UserPlan (if any)
        $this->updateUserWalletAndPlan($user);

        session()->flash('success', 'Registration successful. Please login.');
        return redirect()->route('login');
    }

    // A new function to update main_wallet and plan_id after registration
    private function updateUserWalletAndPlan(User $user)
    {
        $totalEarning = $user->userPlans->sum('total_earning'); // Uses relationship if eager loaded
    
            $user->main_wallet = $user->referral_wallet + $totalEarning;
            $user->plan_id = $user->userPlans()->value('plan_id');  // gets the first plan_id or null
        
            $user->save();
        }
        
    
}
