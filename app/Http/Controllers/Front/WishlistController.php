<?php

namespace App\Http\Controllers\Front;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class WishlistController extends Controller
{
    public function showForm()
    {
        return view('wishlist'); 
    }

    public function apply(Request $request)
    {
        
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'product_name' => 'required|string|max:255',
            'product_specification' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional image upload validation
        ]);

        
        $userId = Auth::id();

        
        $imagePath = null;
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $imagePath = $request->file('image')->store('wishlists', 'public'); 
            }
        }

        // Create a new wishlist entry
        Wishlist::create([
            'user_id' => $userId,
            'customer_name' => $request->customer_name,
            'phone' => $request->phone,
            'product_name' => $request->product_name,
            'product_specification' => $request->product_specification,
            'image' => $imagePath, 
        ]);

        
        return redirect()->back()->with('success', 'Wishlist item added successfully!');
    }

    //for admin
    public function index() {
        $wishlists = Wishlist::all();
        return view('admin.wishlists.index', compact('wishlists'));
    }

    public function destroy(Wishlist $wishlist) {
        if ($wishlist->image) {
            Storage::delete('public/' . $wishlist->image); 
        }

        $wishlist->delete();
        return redirect()->route('admin.wishlists.index')->with('success', 'wishlist deleted successfully!');
    }

}
