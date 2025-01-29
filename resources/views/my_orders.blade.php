@extends('layout')

@section('title', 'My Orders')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">My Orders</h1>

    @if($orders->isEmpty())
        <p class="text-gray-500">No orders found.</p>
    @else
        @foreach($orders as $order)
            <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                <h2 class="text-xl font-semibold mb-2">Order ID: {{ $order->id }}</h2>
                <p class="text-gray-700">Ordered Date: <span class="font-medium">{{ $order->ordered_date->format('Y-m-d') }}</span></p>
                <p class="text-gray-700">Delivery Date: <span class="font-medium">{{ $order->delivery_date->format('Y-m-d') }}</span></p>
                <p class="text-gray-700">Quantity: <span class="font-medium">{{ $order->quantity }}</span></p>
                <p class="text-gray-700">Total Amount: <span class="font-medium">Rs.{{ $order->total_amount }}</span></p>
                
                @if($order->plant)
                    <h3 class="text-lg font-semibold mt-4">Ordered Plant</h3>
                    <div class="flex items-center mb-2">
                        <img src="{{ asset('storage/' . $order->plant->image) }}" alt="{{ $order->plant->name }}" class="w-20 h-20 object-cover rounded">
                        <p class="ml-4 p-4">{{ $order->plant->name }}</p>
                    </div>
                @else
                    <p class="text-gray-500"></p>
                @endif

                @if($order->pot)
                    <h3 class="text-lg font-semibold mt-4">Ordered Pot</h3>
                    <div class="flex items-center mb-2">
                        <img src="{{ asset('storage/' . $order->pot->image) }}" alt="{{ $order->pot->name }}" class="w-20 h-20 object-cover rounded">
                        <p class="ml-4 p-4">{{ $order->pot->name }}</p>
                    </div>
                @else
                    <p class="text-gray-500"></p>
                @endif

                <hr class="my-4 border-gray-300">
            </div>
        @endforeach
    @endif
</div>
@endsection
