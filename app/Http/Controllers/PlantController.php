<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Plant;
use App\Http\Resources\PlantResource;

class PlantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plants = Plant::with(['orders', 'carts'])->paginate(10);
        return response()->json(PlantResource::collection($plants));
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
            'leave_color' => 'nullable|string|max:255',
            'purchased_date' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $plantData = $request->all();

        if ($request->hasFile('image')) {
            $plantData['image'] = $request->file('image')->store('plants', 'public');
        }

        $plant = Plant::create($plantData);

        return response()->json(new PlantResource($plant), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $plant = Plant::with(['orders', 'carts'])->findOrFail($id);
        return response()->json(new PlantResource($plant));
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
            'leave_color' => 'nullable|string|max:255',
            'purchased_date' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $plant = Plant::findOrFail($id);
        $plantData = $request->all();

        if ($request->hasFile('image')) {
            $plantData['image'] = $request->file('image')->store('plants', 'public');
        }

        $plant->update($plantData);

        return response()->json(new PlantResource($plant));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $plant = Plant::findOrFail($id);
        if ($plant->image) {
            \Storage::disk('public')->delete($plant->image);
        }
        $plant->delete();
        return response()->json(['message' => 'Plant deleted successfully'], 200);
    }
}
