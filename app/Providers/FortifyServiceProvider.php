<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->email)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                return $user;
            }

            return null;
        }); 
        // Define cusom login views based on route
        Fortify::loginView(function () {
            // if (request()->is('admin/login')) {
            //     return view('auth.admin-login');
            // }
            return view('auth.login');
        });
        Fortify::registerView(function () {
            return view('auth.register'); // Ensure Jetstream's register view is used
        });
        Fortify::redirects('login', '/home');
        Fortify::redirects('register', '/home');
        


        // customize the authentication logic
        // Fortify::authenticateUsing(function (Request $request) {
        //     $response = Http::post(config('app.api_url') . '/api/login', [
        //         'email' => $request->email,
        //         'password' => $request->password,
        //     ]);

        //     if ($response->ok()) {
        //         session(['api_token' => $response->json('token')]);

        //         $userData = $response->json('user');
        //         $user = \App\Models\User::find($userData['id']); // Retrieve the user from the database

        //         if ($user) {
        //             Auth::login($user); // log in the user instance
        //             return $user;
        //         }
        //     }

        //     return null;
        // });
    }
}
