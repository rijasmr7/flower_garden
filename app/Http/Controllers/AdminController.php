<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // public function dashboard()
    // {
    //     if (Auth::check() && Auth::user()->role === 'admin') {
    //         return view('admin.dashboard');
    //     }

    //     abort(403, 'Unauthorized access');
    // }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            // Check if the authenticated user is an admin
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin_dash');
            }

            // If not an admin, log out and show an error message
            Auth::logout();
            return back()->withErrors(['email' => 'Unauthorized access'])->onlyInput('email');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    }
}
