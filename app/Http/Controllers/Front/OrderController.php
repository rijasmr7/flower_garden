<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Models\Plant;
use App\Models\Pot;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function show($id, Request $request) {
        
        if (!Auth::check()) {
            return redirect()->route('login')->with('message', 'Please login to proceed with the order.');
        }

        
        $plant = Plant::find($id);
        $pot = null;

        
        if ($request->has('pot_id')) {
            $pot = Pot::find($request->input('pot_id'));
        }

        
        return view('order', compact('plant', 'pot'));
    }

    public function myOrders()
{
    
    if (!Auth::check()) {
        return redirect()->route('login')->with('message', 'Please login to view your orders.');
    }

    $userId = Auth::id();

    $orders = Order::whereHas('customer', function ($query) use ($userId) {
        $query->where('user_id', $userId);
    })->with('orderable')->get();
    return view('my_orders', compact('orders'));
}

public function processOrder(Request $request)
{
    $validatedData = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'phone' => 'required|string|max:15',
        'address' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'province' => 'required|string|max:255',
        'district' => 'required|string|max:255',
        'postal_code' => 'required|string|max:10',
        'quantity' => 'required|integer|min:1',
        'plant_id' => 'nullable|exists:plants,id',  // Corrected validation for 'plants'
        'pot_id' => 'nullable|exists:pots,id',      // Corrected validation for 'pots'
    ]);

    $userId = Auth::id();

    // Check if the customer exists or create a new one
    $customer = Customer::where('user_id', $userId)->first();

    if ($customer) {
        $customer->update($validatedData);
    } else {
        $customer = Customer::create(array_merge($validatedData, ['user_id' => $userId]));
    }

    // Calculate total amount
    $totalAmount = 0;
    $unitPrice = null;

    $orderableType = null;
    $orderableId = null;

    // Handle plant selection
    if ($validatedData['plant_id']) {
        $plant = Plant::findOrFail($validatedData['plant_id']);
        $unitPrice = $plant->price;
        $totalAmount += $unitPrice * $validatedData['quantity'];

        // Set polymorphic relationship details for plant
        $orderableType = Plant::class;
        $orderableId = $plant->id;
    }

    // Handle pot selection
    if ($validatedData['pot_id']) {
        $pot = Pot::findOrFail($validatedData['pot_id']);
        $potUnitPrice = $pot->price;
        $totalAmount += $potUnitPrice * $validatedData['quantity'];

        // Set polymorphic relationship details for pot
        $orderableType = Pot::class;
        $orderableId = $pot->id;

        $unitPrice = $potUnitPrice;
    }

    // Create a new order
    $order = Order::create([
        'customer_id' => $customer->id,
        'orderable_type' => $orderableType,  // Store the type (plant or pot)
        'orderable_id' => $orderableId,      // Store the ID of the related model
        'ordered_date' => now(),
        'delivery_date' => now()->addDays(14),
        'unit_price' => $unitPrice,
        'quantity' => $validatedData['quantity'],
        'total_amount' => $totalAmount,
    ]);

    // Redirect to payment page
    return redirect()->route('payment.show', ['order' => $order->id])
        ->with('message', 'Order placed successfully. Please complete your payment.');
}


    //for admin
    public function view() {
        $orders = Order::all();
        return view('admin.orders.index', compact('orders'));
    }

     // Delete a plant
     public function destroy(Order $order) {

        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'order deleted successfully!');
    }
}
