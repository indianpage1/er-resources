<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Referral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'referral_code' => 'nullable|string|exists:users,referral_code',
        ]);

        // Generate unique referral code
        $referral_code = Str::random(8);

        // Create user
        $user = User::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'referral_code' => $referral_code,
            'referrer_id' => $request->referral_code ? User::where('referral_code', $request->referral_code)->first()->id : null
        ]);

        // Handle referral reward logic
        if ($request->referral_code) {
            $referrer = User::find($user->referrer_id);
            if ($referrer) {
                // Add 200 PKR to the referrer’s wallet
                $referrer->increment('referral_wallet_balance', 200);
                // Increment referrer’s daily earnings by 5%
                $referrer->userPlan->daily_earning_with_increment *= 1.05;
            }
        }

        return redirect()->route('login')->with('success', 'Registration successful! Please login.');
    }
}
