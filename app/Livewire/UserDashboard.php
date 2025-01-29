<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class UserDashboard extends Component
{
    public $users;

    public function mount()
    {
        $respons = Http::withToken(session('api_token'))->get(config('app.api_url') . '/api/users');
        $this->users = $response->ok() ? $response->json() : [];
    }

    public function render()
    {
        return view('livewire.user-dashboard');
    }
}
