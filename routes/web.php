<?php

use App\Http\Controllers\Admin\AdminSaveWithdrawalAccountController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\InvestmentPlanController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\UserWalletSummaryController;
use App\Http\Controllers\PlanController;
use App\Http\Middleware\AuthCheck;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\Admin\UserPlanController;
use App\Http\Controllers\WithdrawalController;
use App\Http\Controllers\AdminWithdrawalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
// 🔹 Publicly accessible routes (home only)
// 🔹 Guest-only routes (unauthenticated users)
// Register

  Route::get('/register', [RegisterController::class, 'showForm'])->name('register');
  Route::post('/register', [RegisterController::class, 'register']);
  
  // Login
  Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Logout
Route::post('logout', [LoginController::class, 'logout'])->name('logout');



Route::middleware([AuthCheck::class])->group(function () {
  Route::get('/rewards', [RewardController::class, 'index'])->name('reward.index');
// 👇 Matches /reward/claim/5
Route::get('/withdrawal/status/latest', [WithdrawalController::class, 'getLatestStatus'])->name('withdrawal.latestStatus');

Route::post('/withdrawal/process', [WithdrawalController::class, 'processWithdrawal'])->name('withdrawal.process');
Route::post('/claim-reward/{planId}', [RewardController::class, 'claimReward'])->name('reward.claim');
Route::post('/withdrawal/save-account', [WithdrawalController::class, 'saveWithdrawalAccount'])->name('withdrawal.saveAccount');
Route::get('/withdrawal', [WithdrawalController::class, 'showWithdrawalForm'])->name('withdrawal.form');
Route::post('/withdrawal', [WithdrawalController::class, 'processWithdrawal'])->name('withdrawal.process');
  Route::get('/home', [FrontendController::class, 'home'])->name('home');
  Route::get('/about', [FrontendController::class, 'about'])->name('about');
  Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
  Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
  Route::get('/plans', [InvestmentPlanController::class, 'showPlans'])->name('plans');
  Route::get('/calculator', [FrontendController::class, 'showCalculator'])->name('calculator');
  Route::post('/calculate', [FrontendController::class, 'calculate'])->name('calculate');
  Route::get('/dashboard', [FrontendController::class, 'dashboard'])->name('dashboard');
});
// 🔐 Authenticated Routes (Protected by Middleware)
Route::middleware([AuthCheck::class])->group(function () {
  Route::get('/withdraw', [FrontendController::class, 'withdraw'])->name('withdraw');
  Route::get('/store-plans', [InvestmentPlanController::class, 'storePlans'])->name('store.plans');

  // Payment
  // In web.php
Route::get('/payment/status/{transaction}', [PaymentController::class, 'showPaymentStatus'])->name('payment.status');

  Route::get('/payment', [PaymentController::class, 'showPaymentPage'])->name('payment.page');
  Route::post('/payment/submit', [PaymentController::class, 'submitPayment'])->name('payment.submit');
  
});
// ==========================================================
// 🔸 Admin Routes
// ==========================================================
// routes/web.php


// Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {
//     Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
// });
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::resource('/admin/plans', PlanController::class);
Route::resource('/admin/users', UserController::class);
Route::resource('/admin/contacts', ContactController::class)->except(['create', 'store']);

// Wallet Summary CRUD Routes (with Admin Prefix)
Route::prefix('admin')->name('admin.')->group(function () {
  Route::get('wallet-summaries', [UserWalletSummaryController::class, 'index'])->name('wallet_summaries.index');
  Route::get('wallet-summaries/{id}/edit', [UserWalletSummaryController::class, 'edit'])->name('wallet_summaries.edit');
  Route::put('wallet-summaries/{id}', [UserWalletSummaryController::class, 'update'])->name('wallet_summaries.update');
  Route::delete('wallet-summaries/{id}', [UserWalletSummaryController::class, 'destroy'])->name('wallet_summaries.delete');
});
// Ensure this is inside the admin route group
Route::prefix('admin')->name('admin.')->group(function () {
  // Existing routes for transactions
  Route::get('user_transactions', [PaymentController::class, 'index'])->name('transactions.index');
  Route::get('user_transactions/{id}', [PaymentController::class, 'show'])->name('transactions.show');
  Route::get('user_transactions/{id}/edit', [PaymentController::class, 'edit'])->name('transactions.edit');
  Route::put('user_transactions/{id}', [PaymentController::class, 'update'])->name('transactions.update');
  Route::delete('user_transactions/{id}', [PaymentController::class, 'destroy'])->name('transactions.destroy');
  Route::put('user_transactions/{id}/update-status', [PaymentController::class, 'updateStatus'])->name('transactions.updateStatus');
  Route::get('user_transactions/{id}/image', [PaymentController::class, 'showImage'])->name('transactions.showImage');


});
// routes/web.php

Route::prefix('admin')->middleware(['auth'])->group(function () {
  Route::get('/user-plans', [UserPlanController::class, 'index'])->name('admin.user_plans.index');
  Route::get('/user-plans/{id}/edit', [UserPlanController::class, 'edit'])->name('admin.user_plans.edit');
  Route::put('/user-plans/{id}', [UserPlanController::class, 'update'])->name('admin.user_plans.update');
  Route::delete('/user-plans/{id}', [UserPlanController::class, 'destroy'])->name('admin.user_plans.destroy');
});

Route::prefix('admin')->middleware(['auth'])->group(function () {
  Route::get('/save-accounts',   [AdminSaveWithdrawalAccountController::class, 'index'])  ->name('admin.save-accounts.index');
  Route::get('/save-accounts/{id}/edit', [AdminSaveWithdrawalAccountController::class, 'edit'])   ->name('admin.save-accounts.edit');
  Route::put('/save-accounts/{id}',      [AdminSaveWithdrawalAccountController::class, 'update']) ->name('admin.save-accounts.update');
  Route::delete('/save-accounts/{id}',   [AdminSaveWithdrawalAccountController::class, 'destroy'])->name('admin.save-accounts.destroy');
});

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('withdrawals', [AdminWithdrawalController::class, 'index'])->name('admin.withdrawals.index');
    Route::post('withdrawals/{id}/update-status', [AdminWithdrawalController::class, 'updateStatus'])->name('admin.withdrawals.updateStatus');
    Route::delete('withdrawals/{id}', [AdminWithdrawalController::class, 'destroy'])->name('admin.withdrawals.destroy');
});

