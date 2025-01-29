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
    })->with('plant', 'pot')->get(); 

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
        'quantity' => 'required|integer|min:1', // Quantity from the form
        'plant_id' => 'nullable|exists:plant,id', // Plant ID is nullable
        'pot_id' => 'nullable|exists:pot,id', // Pot ID is nullable
    ]);

    
    $userId = Auth::id();

    
    $customer = Customer::where('user_id', $userId)->first();

    if ($customer) {
        
        $customer->update($validatedData);
    } else {
        // Create a new customer
        $customer = Customer::create(array_merge($validatedData, ['user_id' => $userId]));
    }

    
    $totalAmount = 0;
    $unitPrice = null;

    
    if ($validatedData['plant_id']) {
        $plant = Plant::findOrFail($validatedData['plant_id']);
        $unitPrice = $plant->price;
        $totalAmount += $unitPrice * $validatedData['quantity']; 
    }

    
    if ($validatedData['pot_id']) {
        $pot = Pot::findOrFail($validatedData['pot_id']);
        $potUnitPrice = $pot->price;
        $totalAmount += $potUnitPrice * $validatedData['quantity']; 
        
        
        $unitPrice = $potUnitPrice;
    }

    // Create a new order record
    $order = Order::create([
        'customer_id' => $customer->id, 
        'plant_id' => $validatedData['plant_id'], 
        'pot_id' => $validatedData['pot_id'], 
        'ordered_date' => now(), 
        'delivery_date' => now()->addDays(14), 
        'unit_price' => $unitPrice, 
        'quantity' => $validatedData['quantity'],
        'total_amount' => $totalAmount,
    ]);

    // Redirect to payment page after order is placed successfully
    return redirect()->route('payment.show', ['order' => $order->id])->with('message', 'Order placed successfully. Please complete your payment.');
        
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
