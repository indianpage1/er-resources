<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserWalletSummary;

class UserWalletSummaryController extends Controller
{
    public function updateEarning(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0',
        ]);
    
        $user = \App\Models\User::find($request->user_id);
        $user->main_wallet += $request->amount;
        $user->save();
    
        $summary = UserWalletSummary::firstOrCreate(['user_id' => $user->id]);
        $summary->total_earning += $request->amount; // ✅ ADD instead of REPLACE
        $summary->save();
        
        return response()->json(['message' => 'Earning updated successfully']);
    }
    

    public function updateWithdrawal(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0',
        ]);

        $summary = UserWalletSummary::firstOrCreate(['user_id' => $request->user_id]);
        $summary->total_withdrawal += $request->amount;
        $summary->save();

        return response()->json(['message' => 'Withdrawal updated successfully']);
    }

    public function index()
    {
        $summaries = \App\Models\UserWalletSummary::with('user')->get();
        return view('admin.wallet_summaries.index', compact('summaries'));
    }

    // ✅ New methods added below:

    public function edit($id)
    {
        $summary = UserWalletSummary::findOrFail($id);
        return view('admin.wallet_summaries.edit', compact('summary'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'total_earning' => 'required|numeric|min:0',
            'total_withdrawal' => 'required|numeric|min:0',
        ]);

        $summary = UserWalletSummary::findOrFail($id);
        $summary->update($request->only('total_earning', 'total_withdrawal'));

        return redirect()->route('wallet.summary.index')->with('success', 'Wallet summary updated.');
    }

    public function destroy($id)
    {
        UserWalletSummary::findOrFail($id)->delete();
        return back()->with('success', 'Wallet summary deleted.');
    }
}
