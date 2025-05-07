<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Referral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReferralController extends Controller
{
    public function trackReferral($referral_code)
    {
        // Get the referrer by referral code
        $referrer = User::where('referral_code', $referral_code)->first();

        if ($referrer) {
            // Get the currently authenticated user (the referred user)
            $user = auth()->user();
            $rewardAmount = 200; // Reward amount for both wallets

            // Check if the user is already referred, to prevent multiple rewards for the same user
            if ($user->referrer_id) {
                return response()->json([
                    'error' => 'You have already been referred.'
                ], 400);
            }

            // Start a transaction to ensure atomic operations
            DB::beginTransaction();
            
            try {
                // Add the referrer as the user's referrer
                $user->referrer_id = $referrer->id;
                $user->save();

                // Debugging: Check current main_wallet before update
                \Log::info('User current main_wallet: ' . $user->main_wallet);

                // Update the referred user's main wallet with the reward amount
                $user->main_wallet += $rewardAmount; // Directly add to the main_wallet
                $user->save();

                // Debugging: Check if main_wallet updated correctly
                \Log::info('User updated main_wallet: ' . $user->main_wallet);

                // Create a new referral record
                Referral::create([
                    'user_id' => $referrer->id, // referrer
                    'referred_user_id' => $user->id, // referred user
                    'referral_code' => $referral_code,
                    'reward_amount' => $rewardAmount,
                ]);

                // Add reward to the referrer's referral wallet
                $referrer->referral_wallet += $rewardAmount; // Add to referral_wallet
                $referrer->save();

                // Increment the referrer’s referred users count
                $referrer->total_referred_users++;
                $referrer->save();

                // Commit the transaction if everything was successful
                DB::commit();

                return response()->json([
                    'message' => 'Referral successful! Both wallets have been credited with 200 PKR.'
                ]);
            } catch (\Exception $e) {
                // Rollback the transaction if there is any error
                DB::rollback();
                return response()->json([
                    'error' => 'An error occurred. Please try again later.'
                ], 500);
            }
        }

        // If the referral code doesn't match, return an error response
        return response()->json([
            'error' => 'Invalid referral code.'
        ], 400);
    }
}
