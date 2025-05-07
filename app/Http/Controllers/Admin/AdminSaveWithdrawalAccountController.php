<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SaveWithdrawlAccount;


class AdminSaveWithdrawalAccountController extends Controller
{
    public function index()
    {
        $accounts = SaveWithdrawlAccount::latest()->paginate(10);
        return view('admin.save_accounts.index', compact('accounts'));
    }
    public function edit($id)
    {
        $account = SaveWithdrawlAccount::findOrFail($id);
        // return JSON → return response()->json($account);
        
        // return the edit blade with the model
        return view('admin.save_accounts.edit', compact('account'));
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'account_holder_name' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:20',
            'method' => 'required|in:JazzCash,EasyPaisa',
        ]);

        SaveWithdrawlAccount::create($request->all());

        return back()->with('success', 'Account added successfully.');
    }

    public function update(Request $request, $id)
    {
        // validate (optional but recommended)
        $data = $request->validate([
            'account_holder_name' => 'required|string|max:255',
            'mobile_number'       => 'required|string|max:20',
            'method'              => 'required|in:JazzCash,EasyPaisa',
        ]);
    
        $account = SaveWithdrawlAccount::findOrFail($id);
        $account->update($data);
    
        // redirect to the index page with a flash message
        return redirect()
            ->route('admin.save-accounts.index')
            ->with('success', 'Account updated successfully.');
    }
    
    public function destroy($id)
    {
        SaveWithdrawlAccount::destroy($id);
        return back()->with('success', 'Account deleted successfully.');
    }
}
