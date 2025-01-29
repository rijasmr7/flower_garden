<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Pot;
use App\Http\Resources\PotResource;

class PotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pots = Pot::with(['orders', 'carts'])->paginate(10);
        return response()->json(PotResource::collection($pots));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'size' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:255',
            'is_available' => 'required|boolean',
            'quantity' => 'required|integer',
            'pot_color' => 'nullable|string|max:255',
            'purchased_date' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $potData = $request->all();

        if ($request->hasFile('image')) {
            $potData['image'] = $request->file('image')->store('pots', 'public');
        }

        $pot = Pot::create($potData);

        return response()->json(new PotResource($pot), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pot = Pot::with(['orders', 'carts'])->findOrFail($id);
        return response()->json(new PotResource($pot));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'price' => 'nullable|numeric',
            'size' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:255',
            'is_available' => 'nullable|boolean',
            'quantity' => 'nullable|integer',
            'pot_color' => 'nullable|string|max:255',
            'purchased_date' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $pot = Pot::findOrFail($id);
        $potData = $request->all();

        if ($request->hasFile('image')) {
            $potData['image'] = $request->file('image')->store('pots', 'public');
        }

        $pot->update($potData);

        return response()->json(new PotResource($pot));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pot = Pot::findOrFail($id);
        if ($pot->image) {
            \Storage::disk('public')->delete($pot->image);
        }
        $pot->delete();
        return response()->json(['message' => 'Pot deleted successfully'], 200);
    }
}
