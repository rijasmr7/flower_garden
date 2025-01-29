<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class AdminLogin extends Component
{
    public $email, $password;

    public function login()
    {
        $this->validate([
            'email' =>'required|email',
            'password' => 'required',
        ]);

        //make HTTP request to backend api
        $response = Http::post('/api/login', [
            'email' => $this->email,
            'password' => $this->password,
            'user_type' => 'user',
        ]);

        if ($response->successful()) {
            //Handle successful login
            session(['user_token' => $response->json()['token']]);
            session()->flash('message', 'User login successful');
            return redirect()->route('user.dashboard');
        } else {
            //handle failed login
            session()->flash('error', 'Invalid login credentials');
        }
    }

    public function render()
    {
        return view('livewire.user-login');
    }
}
