<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {


        // Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // Credentials array
        $credentials = $request->only('email', 'password');

        // Attempt login
        if (Auth::attempt($credentials)) {
            // Success - redirect to intended page
            return redirect()->intended('dashboard');
        }

        // Failed - redirect back with error
        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ])->withInput();
    }
    public function logout(Request $request)
{
    Auth::logout();

    // Invalidate the session
    $request->session()->invalidate();

    // Regenerate CSRF token
    $request->session()->regenerateToken();

    return redirect('/login'); // Ya jahan redirect karna ho logout ke baad
}
}
