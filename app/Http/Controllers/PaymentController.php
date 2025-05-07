<?php

namespace App\Http\Controllers;

use App\Models\InvestmentPlan;
use Illuminate\Http\Request;
use App\Models\UserTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\UserPlan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    /**
     * Display the payment page with selected plan details.
     */
    public function showPaymentPage(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'daily_return' => 'required|numeric',
            'withdrawal_limit' => 'required|numeric',
            
        ]);
    
        // Plan details ko retrieve karna
        $planDetails = $request->only(['id', 'plan_name', 'amount', 'daily_return', 'withdrawal_limit',]);
        // View ko return karte waqt planDetails bhej dena
        return view('payment', compact('planDetails'));
        // dd($planDetails);

    }
   /**     * Handle payment form submission    */
// Controller Method
public function submitPayment(Request $request)
{


    $request->validate([
        'amount' => 'required|numeric',
        'payment_screenshot' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);
    

    // File ko store karna
    $file = $request->file('payment_screenshot');
    $filename = 'payment_' . time() . '.' . $file->getClientOriginalExtension();
    $destinationPath = public_path('uploads/payments');
    $file->move($destinationPath, $filename);


    $user = Auth::user();

    // Transaction create karte waqt hidden fields ko bhi add kar dena
    $transaction = UserTransaction::create([
        'user_id' => $user->id,
        'user_name' => $user->name,
        'payment_screenshot' => 'uploads/payments/' . $filename,
        'plan_amount' => $request->amount,  
        'plan_Name' => $request->plan_Name, 
        'plan_id' => $request->plan_id,     
    ]);
    
        
    
    // Status page pe redirect karna
    return redirect()->route('payment.status', ['transaction' => $transaction->id]);
}

public function showPaymentStatus($id)
{
    // Find the transaction
    $transaction = UserTransaction::find($id);

    // If the transaction doesn't exist, redirect to the home page
    if (!$transaction) {
        return redirect('home')->with('error', 'Transaction not found.');
    }

    // Check if the transaction status is still pending
    if ($transaction->status == 'pending') {
        // Set the time remaining to 15 minutes (15 * 60 seconds)
        $timeRemaining = 15 * 60;
    } else {
        // If the status is not pending, reset time to 0 (no countdown)
        $timeRemaining = 0;
    }

    // Pass transaction and timeRemaining to the view
    return view('payment.status', compact('transaction', 'timeRemaining'));
}







public function updateStatus(Request $request, $id)
{
    $transaction = UserTransaction::findOrFail($id);

    // Validate the status value
    $validStatuses = ['accepted', 'rejected', 'pending'];
    if (!in_array($request->status, $validStatuses)) {
        return redirect()->route('admin.transactions.index')->with('error', 'Invalid status.');
    }

    DB::beginTransaction();

    try {
        // Update the status of the transaction
        $transaction->update([
            'status' => $request->status,
        ]);

        // If status is 'accepted', handle investment plan processing
        if ($request->status === 'accepted') {
            $plan = InvestmentPlan::find($transaction->plan_id);

            if ($plan) {
                UserPlan::create([
                    'user_id'                      => $transaction->user_id,
                    'plan_id'                      => $transaction->plan_id,
                    'amount_invested'              => $transaction->plan_amount,
                    'total_earning'                => 0,                   // ← reset to zero
                    'daily_earning'                => $plan->daily_return,
                    'daily_earning_with_increment' => $plan->daily_return + 0.5,
                    'plan_name'                    => $transaction->plan_Name,
                ]);

                $plan->status = 'active';
                $plan->save();
            }
        }

        DB::commit();
        return redirect()->route('admin.transactions.index')->with('success', 'Transaction status updated.');

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Error updating transaction status: ' . $e->getMessage());
        return redirect()->route('admin.transactions.index')->with('error', 'Failed to update the transaction status.');
    }
}


    public function index()
    {
        $transactions = UserTransaction::latest()->paginate(10);
        return view('admin.user_transactions.index', compact('transactions'));
    }

    /**
     * Admin Panel: View single transaction.
     */
    public function show($id)
    {
        $transaction = UserTransaction::findOrFail($id);
        return view('admin.user_transactions.show', compact('transaction'));
    }
    public function showImage($id)
    {
        // Get the transaction from the database
        $transaction = UserTransaction::findOrFail($id);
        
        // Return the view to show the image
        return view('admin.user_transactions.show_image', compact('transaction'));
    }
    /**
     * Admin Panel: Edit transaction.
     */
    public function edit($id)
    {
        $transaction = UserTransaction::findOrFail($id);
        return view('admin.user_transactions.edit', compact('transaction'));
    }

   /**
     * Admin Panel: Update transaction.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'plan_number' => 'required|numeric',
            // Add other validation rules as needed
        ]);

        $transaction = UserTransaction::findOrFail($id);
        $transaction->update($request->only(['plan_number'])); // Add other fields as needed

        return redirect()->route('admin.transactions.index')->with('success', 'Transaction updated successfully.');
    }
    /**
     * Admin Panel: Delete transaction.
     */
    public function destroy($id)
    {
        $transaction = UserTransaction::findOrFail($id);

        // Delete the payment screenshot file if it exists
        if (Storage::exists($transaction->payment_screenshot)) {
            Storage::delete($transaction->payment_screenshot);
        }

        $transaction->delete();

        return redirect()->route('admin.transactions.index')->with('success', 'Transaction deleted successfully.');
    }
}