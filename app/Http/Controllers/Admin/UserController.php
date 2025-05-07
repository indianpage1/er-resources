<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserPlan;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Eager load userPlans
        $users = User::with('userPlans')->latest()->paginate(15);

        // Calculate and update main_wallet for all users
        foreach ($users as $user) {

            $totalEarning = $user->userPlans->sum('total_earning');
            
            // Calculate main_wallet and plan_id
            $user->main_wallet = $user->referral_wallet + $totalEarning;
            $user->plan_id = $user->userPlans()->latest()->first()->plan_id ?? null;

            // Save the updated main_wallet and plan_id
            $user->save();
        }

        return view('admin.users.index', compact('users'));
    }



    public function create()
    {
        return view('admin.users.create');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User deleted.');
    }
}
