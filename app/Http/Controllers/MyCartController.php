<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\MyCartResource;
use App\Models\MyCart;

class MyCartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cartItems = MyCart::with(['user', 'cartable'])->paginate(10);
        return response()->json(MyCartResource::collection($cartItems));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:customers,id',
            'cartable_type' => 'required|string',
            'cartable_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $cartItem = MyCart::create($request->all());
        return response()->json(new MyCartResource($cartItem), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cartItem = MyCart::with(['user', 'cartable'])->findOrFail($id);
        return response()->json(new MyCartResource($cartItem));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'cartable_type' => 'nullable|string',
            'cartable_id' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $cartItem = MyCart::findOrFail($id);
        $cartItem->update($request->all());
        return response()->json(new MyCartResource($cartItem));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cartItem = MyCart::findOrFail($id);
        $cartItem->delete();
        return response()->json(['message' => 'Cart item deleted successfully'], 200);
    }
}
