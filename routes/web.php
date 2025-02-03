<?php

use Illuminate\Support\Facades\Route;
use App\Models\Customer;
use App\Models\User;
use App\Models\Plant;
use App\Models\Pot;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Front\RegisterController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\LoginController;
use App\Http\Controllers\Front\UserController;
use App\Http\Controllers\Front\OrderController;
use App\Http\Controllers\Front\PlantController;
use App\Http\Controllers\Front\PotController;
use App\Http\Controllers\Front\PaymentController;
use App\Http\Controllers\Front\GardeningController;
use App\Http\Controllers\Front\WishlistController;
use App\Http\Controllers\Front\TextusController;
use App\Http\Controllers\Front\Controller;
use App\Livewire\AdminLogin;
use App\Livewire\UserLogin;
use App\Http\Middleware\AdminMiddleware;

// Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
// Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::get('/home', [PageController::class, 'home'])->name('home'); 

// Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [LoginController::class, 'login'])->name('login');


Route::get('/', function () {
    return view('welcome');
});

Route::get('test', function() {
    $customer = Customer::find(4);
    //return $customer->orders;
    // return $customer->carts;
    // return $customer->wishlists;
    // return $customer->inquiries;
    // return $customer->gardenings;

    $user = User::find(10);
    // return $user->reviews;
    // return $user->customer;

    $plant = Plant::find(10);
    // return $plant->orders;
    // return $plant->carts;

    $pot = Pot::find(1);
    // return $pot->orders;
    return $pot->carts;
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// // Admin login route
// Route::get('/admin/login', AdminLogin::class)->name('admin.login');

// // User login route
// // Route::get('/login', UserLogin::class)->name('user.login');

// Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/home');
})->name('logout');

Route::post('/adminLogout', function () {
    Auth::logout();
    return redirect('/admin');
})->name('adminLogout');



//admin dashboard
// Route::get('/admin', function () {
//     return view('admin_dash'); 
// });
Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('/admin_dash', function () {
        return view('admin_dash');
    })->name('admin_dash');

    //Admin-users
Route::prefix('admin')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});

// Plant routes
Route::prefix('admin')->group(function() {
    Route::get('/products', [PlantController::class, 'show'])->name('admin.products');
    Route::get('plants', [PlantController::class, 'index'])->name('admin.plants.index');
    Route::get('plants/create', [PlantController::class, 'create'])->name('admin.plants.create');
    Route::post('plants', [PlantController::class, 'store'])->name('admin.plants.store');
    Route::get('plants/{plant}/edit', [PlantController::class, 'edit'])->name('admin.plants.edit');
    Route::put('plants/{plant}', [PlantController::class, 'update'])->name('admin.plants.update');
    Route::delete('plants/{plant}', [PlantController::class, 'destroy'])->name('admin.plants.destroy');
    
    // Pot routes
    Route::get('pots', [PotController::class, 'index'])->name('admin.pots.index');
    Route::get('pots/create', [PotController::class, 'create'])->name('admin.pots.create');
    Route::post('pots', [PotController::class, 'store'])->name('admin.pots.store');
    Route::get('pots/{pot}/edit', [PotController::class, 'edit'])->name('admin.pots.edit');
    Route::put('pots/{pot}', [PotController::class, 'update'])->name('admin.pots.update');
    Route::delete('pots/{pot}', [PotController::class, 'destroy'])->name('admin.pots.destroy');
});


});
//for users

Route::get('/plants', [PlantController::class, 'showPlants'])->name('plants');
Route::get('/plants/{id}', [PlantController::class, 'showDetail'])->name('web.plants.show');

Route::get('/pots', [PotController::class, 'showPots'])->name('pots');
Route::get('/pots/{pot}', [PotController::class, 'showDetail'])->name('web.pots.show');

//Add to cart

Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');

//cart-admin routes
Route::get('carts', [CartController::class, 'view'])->name('admin.carts.index');
Route::delete('carts/{cart}', [CartController::class, 'destroy'])->name('admin.carts.destroy');

//make orders
Route::get('/order/{plant}', [OrderController::class, 'show'])->name('order.show');
Route::post('/order/process', [OrderController::class, 'processOrder'])->name('order.process');

Route::get('/payment/{order}', [PaymentController::class, 'show'])->name('payment.show');
Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');

Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('my.orders');

//order-admin routes
Route::get('orders', [OrderController::class, 'view'])->name('admin.orders.index');
Route::delete('orders/{order}', [OrderController::class, 'destroy'])->name('admin.orders.destroy');

//Garden routes
Route::get('/gardening', [GardeningController::class, 'showForm'])->name('gardening.form');
Route::post('/gardening/apply', [GardeningController::class, 'apply'])->name('gardening.apply');

//Gardening-admin routes
Route::get('gardens', [GardeningController::class, 'view'])->name('admin.gardenings.index');
Route::delete('gardens/{garden}', [GardeningController::class, 'destroy'])->name('admin.gardens.destroy');

//Wishlist routes
Route::get('/wishlist', [WishlistController::class, 'showForm'])->name('wishlist.form');
Route::post('/wishlist/apply', [WishlistController::class, 'apply'])->name('wishlist.apply');

//Wishlist-admin routes
Route::get('wishlists', [WishlistController::class, 'index'])->name('admin.wishlists.index');
Route::delete('wishlists/{wishlist}', [WishlistController::class, 'destroy'])->name('admin.wishlists.destroy');

//Text us routes
Route::get('/textus', [TextusController::class, 'show'])->name('textus.show');
Route::post('/textus/send', [TextusController::class, 'send'])->name('textus.send');

//Text us-admin routes
Route::get('inquiries', [TextusController::class, 'view'])->name('admin.inquiries.index');
Route::delete('inquiries/{inquiry}', [TextusController::class, 'destroy'])->name('admin.inquiries.destroy');
    




Route::post('/toggle-dark-mode', function (Request $request) {
    $darkMode = $request->session()->get('dark_mode', false);
    $request->session()->put('dark_mode', !$darkMode);
    return response()->json(['dark_mode' => !$darkMode]);
})->name('toggle-dark-mode');


// //Admin dashboard Route
// Route::middleware('auth')->group(function () {
//     Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
// });

// //Admin login route
// Route::middleware('guest')->group(function () {
//     Route::get('/admin/login', [AdminLoginController::class, 'create'])->name('admin.login');
//     Route::post('/admin/login', [AdminLoginController::class, 'store']);
// });

// //Admin logout route
// Route::post('/admin/logout', [AdminLoginController::class, 'destroy'])->name('admin.logout');

Route::get('/admin', function () {
    return view('admin.admin-login');
})->name('admin.login');
Route::post('/admin', [AdminController::class, 'login'])->name('admin.login');