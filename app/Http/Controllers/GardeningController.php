<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\GardeningResource;
use App\Models\Gardening;

class GardeningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gardening = Gardening::with(['customer'])->paginate(10);
        return response()->json(GardeningResource::collection($gardening));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|exists:customers,id',
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'gardening_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $gardening = Gardening::create($request->all());
        return response()->json(new GardeningResource($gardening), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $gardening = Gardening::with(['customer'])->findOrFail($id);
        return response()->json(new GardeningResource($gardening));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'customer_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'gardening_date' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $gardening = Gardening::findOrFail($id);
        $gardening->update($request->all());
        return response()->json(new GardeningResource($gardening));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $gardening = Gardening::findOrFail($id);
        $gardening->delete();
        return response()->json(['message' => 'Gardening record deleted successfully'], 200);
    }
}
