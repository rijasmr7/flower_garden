@extends('layout')

@section('title', 'Payment for Order #' . $order->id)

@section('content')
    <div class="container mx-auto my-10">
        <h1 class="text-3xl font-bold mb-6">Payment Details for Order #{{ $order->id }}</h1>

        @if (session('message'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-6">
                {{ session('message') }}
            </div>
        @endif

        <form action="{{ route('payment.process') }}" method="POST">
            @csrf

            
            <div class="mb-4">
                <label for="card_name" class="block text-sm font-medium">Cardholder Name</label>
                <input type="text" id="card_name" name="card_name" class="mt-1 block w-full rounded-md border-gray-300" required>
            </div>

            
            <div class="mb-4">
                <label for="card_number" class="block text-sm font-medium">Card Number</label>
                <input type="text" id="card_number" name="card_number" class="mt-1 block w-full rounded-md border-gray-300" required>
            </div>

            
            <div class="mb-4">
                <label for="expiry_date" class="block text-sm font-medium">Expiry Date</label>
                <input type="text" id="expiry_date" name="expiry_date" placeholder="MM/YY" class="mt-1 block w-full rounded-md border-gray-300" required>
            </div>

            
            <div class="mb-4">
                <label for="cvv" class="block text-sm font-medium">CVV</label>
                <input type="text" id="cvv" name="cvv" class="mt-1 block w-full rounded-md border-gray-300" required>
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded mt-4">
                Proceed to Pay
            </button>
        </form>
    </div>
@endsection
