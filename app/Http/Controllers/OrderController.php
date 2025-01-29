<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\OrderResource;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with(['customer', 'orderable'])->paginate(10);
        return response()->json(OrderResource::collection($orders));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|exists:customers,id',
            'orderable_type' => 'required|string',
            'orderable_id' => 'required|integer',
            'ordered_date' => 'required|date',
            'delivery_date' => 'required|date',
            'unit_price' => 'required|numeric',
            'quantity' => 'required|integer',
            'total_amount' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $order = Order::create($request->all());
        return response()->json(new OrderResource($order), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::with(['customer', 'orderable'])->findOrFail($id);
        return response()->json(new OrderResource($order));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'orderable_type' => 'nullable|string',
            'orderable_id' => 'nullable|integer',
            'ordered_date' => 'nullable|date',
            'delivery_date' => 'nullable|date',
            'unit_price' => 'nullable|numeric',
            'quantity' => 'nullable|integer',
            'total_amount' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $order = Order::findOrFail($id);
        $order->update($request->all());
        return response()->json(new OrderResource($order));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return response()->json(['message' => 'Order deleted successfully'], 200);
    }
}
