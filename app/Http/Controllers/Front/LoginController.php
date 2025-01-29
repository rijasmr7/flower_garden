<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user(); 
        
            // If not admin, redirect to the home page
            return redirect()->intended('/home')->with('success', 'Welcome, ' . $user->name);
        } else {
            return redirect()->back()->withErrors(['error' => 'Invalid credentials. Please try again.']);
        }
        
    }
}
