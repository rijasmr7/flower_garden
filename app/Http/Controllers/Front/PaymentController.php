<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Models\Order;

class PaymentController extends Controller
{
    public function show(Order $order)
    {
        return view('payment', compact('order'));
    }

    public function process(Request $request)
    {
        return redirect()->route('my.orders')->with('message', 'Payment successful! Your orders have been recorded.');

    }
}
