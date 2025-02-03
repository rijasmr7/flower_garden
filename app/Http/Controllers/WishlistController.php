<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\WishlistResource;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wishlists = Wishlist::with('customer')->paginate(10);
        return response()->json(WishlistResource::collection($wishlists));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:customers,id',
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'product_name' => 'required|string|max:255',
            'product_specification' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $wishlistData = $request->all();

        if ($request->hasFile('image')) {
            $wishlistData['image'] = $request->file('image')->store('wishlist_images', 'public');
        }

        $wishlist = Wishlist::create($wishlistData);
        return response()->json(new WishlistResource($wishlist), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $wishlist = Wishlist::with('customer')->findOrFail($id);
        return response()->json(new WishlistResource($wishlist));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'customer_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15',
            'product_name' => 'nullable|string|max:255',
            'product_specification' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $wishlist = Wishlist::findOrFail($id);

        if ($request->hasFile('image')) {
            $wishlistData = $request->all();
            $wishlistData['image'] = $request->file('image')->store('wishlist_images', 'public');
            $wishlist->update($wishlistData);
        } else {
            $wishlist->update($request->all());
        }

        return response()->json(new WishlistResource($wishlist));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $wishlist = Wishlist::findOrFail($id);
        if ($wishlist->image) {
            \Storage::disk('public')->delete($wishlist->image);
        }
        $wishlist->delete();
        return response()->json(['message' => 'Wishlist deleted successfully'], 200);
    }
}
