<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Models\Plant;
use App\Models\MyCart;
use App\Models\Pot;

class CartController extends Controller
{
    
    public function index()
    {
        $userId = auth()->check() ? auth()->id() : null;

        if ($userId) {
            
            $cartItems = MyCart::with(['plant', 'pot'])->where('user_id', $userId)->get();
            return view('cart', ['cartItems' => $cartItems]);
        }

        return redirect('/login')->with('message', 'Please log in to view your cart.');
    }

   
    public function addToCart(Request $request)
    {
        $userId = auth()->check() ? auth()->id() : null;

        $userId = auth()->check() ? auth()->id() : null;

    if ($userId) {
        
        $plant = $request->plant_id ? Plant::find($request->plant_id) : null;
        $pot = $request->pot_id ? Pot::find($request->pot_id) : null;

        
        if ($request->plant_id && !$plant) {
            return redirect()->back()->with('error', 'Plant not found.');
        }

        
        if ($request->pot_id && !$pot) {
            return redirect()->back()->with('error', 'Pot not found.');
        }

        
        MyCart::create([
            'user_id' => $userId,
            'plant_id' => $request->plant_id, 
            'pot_id' => $request->pot_id,     
        ]);

        return redirect('/cart')->with('success', 'Item added to cart successfully.');
    }

    return redirect('/login')->with('message', 'Please register or log in to add items to the cart.');
    }

    // Remove item from cart
    public function removeFromCart($id)
    {
        $userId = auth()->id();
        MyCart::where('id', $id)->where('user_id', $userId)->delete();

        return redirect('/cart')->with('success', 'Item removed from cart successfully.');
    }

    //for admin
    public function view() {
        $carts = MyCart::all();
        return view('admin.carts.index', compact('carts'));
    }

     // Delete a plant
     public function destroy(MyCart $cart) {

        $cart->delete();
        return redirect()->route('admin.carts.index')->with('success', 'cart deleted successfully!');
    }
}
