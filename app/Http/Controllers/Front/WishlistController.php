<?php

namespace App\Http\Controllers\Front;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Services\FirebaseService; // Import FirebaseService

class WishlistController extends Controller
{
    protected $firebaseService;

    public function __construct(FirebaseService $firebaseService)
    {
        $this->firebaseService = $firebaseService; // Inject the FirebaseService
    }

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

        // Create a new wishlist entry in the database
        $wishlist = Wishlist::create([
            'user_id' => $userId,
            'customer_name' => $request->customer_name,
            'phone' => $request->phone,
            'product_name' => $request->product_name,
            'product_specification' => $request->product_specification,
            'image' => $imagePath, 
        ]);

        // Prepare data for Firebase
        $firebaseData = [
            'user_id' => $userId,
            'customer_name' => $request->customer_name,
            'phone' => $request->phone,
            'product_name' => $request->product_name,
            'product_specification' => $request->product_specification,
            'image' => $imagePath,
        ];

        // Store the wishlist data in Firebase
        $this->firebaseService->storeWishlistToFirebase($firebaseData);

        return redirect()->back()->with('success', 'Wishlist item added successfully!');
    }

    // For admin
    public function index() 
    {
        // Retrieve data from Firebase
        $firebaseWishlists = $this->firebaseService->getWishlistsFromFirebase();

        return view('admin.wishlists.index', compact('firebaseWishlists'));
    }

    public function destroy($wishlistId) 
    {
        $wishlist = Wishlist::where('id', $wishlistId)->first();
        if ($wishlist && $wishlist->image) {
            Storage::delete('public/' . $wishlist->image);
        }
    
        if ($wishlist) {
            $wishlist->delete();
        }
        
        $this->firebaseService->deleteWishlistFromFirebase($wishlistId);
    
        return redirect()->route('admin.wishlists.index')->with('success', 'Wishlist deleted successfully!');
    }
    
}
