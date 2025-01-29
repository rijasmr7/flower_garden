@extends('layout')

@section('title', 'Wishlist')

@section('content')
<div class="container mx-auto py-8 flex space-x-8">
    
    <div class="w-full lg:w-1/2 bg-white p-8 shadow-lg rounded-lg">
        <h2 class="text-3xl font-bold mb-6 text-green-600">Tell Us Your Wishlist</h2>
        <form action="{{ route('wishlist.apply') }}" method="POST" enctype="multipart/form-data">
            @csrf

            
            <div class="mb-4">
                <label for="customer_name" class="block text-lg font-medium text-gray-700">Your Name</label>
                <input type="text" name="customer_name" id="customer_name" class="mt-1 block w-full p-3 rounded-md border border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500" required>
            </div>

            
            <div class="mb-4">
                <label for="phone" class="block text-lg font-medium text-gray-700">Phone Number</label>
                <input type="tel" name="phone" id="phone" class="mt-1 block w-full p-3 rounded-md border border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500" required>
            </div>

            
            <div class="mb-4">
                <label for="product_name" class="block text-lg font-medium text-gray-700">Plant or Pot Name</label>
                <input type="text" name="product_name" id="product_name" class="mt-1 block w-full p-3 rounded-md border border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500" required>
            </div>

            
            <div class="mb-4">
                <label for="product_specification" class="block text-lg font-medium text-gray-700">Plant Specification</label>
                <textarea name="product_specification" id="product_specification" rows="4" class="mt-1 block w-full p-3 rounded-md border border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500" placeholder="Describe your preferences..."></textarea>
            </div>

            
            <div class="mb-4">
                <label for="image" class="block text-lg font-medium text-gray-700">Upload Plant Image (optional)</label>
                <input type="file" name="image" id="image" class="mt-1 block w-full p-3 rounded-md border border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500">
            </div>
            @if (Auth::check())
            <button type="submit" class="w-full bg-green-600 text-white font-semibold py-3 rounded-md hover:bg-green-700 transition ease-in-out duration-300">Send</button>
            @else
                <p class="text-red-500 mt-4">Please <a href="{{ route('login') }}" class="text-blue-500">login</a> or <a href="{{ route('register') }}" class="text-blue-500">register</a> to send wishlists.</p>
            @endif
        </form>
    </div>

    
    <div class="hidden lg:block w-1/3 bg-gray-100 p-8 rounded-lg shadow-lg">
        <h3 class="text-2xl font-semibold text-green-600 mb-4">Why Create a Wishlist?</h3>
        <p class="mb-4">
            A wishlist allows you to express your preferences for plants or pots that you desire. 
            By sharing your wishlist with us, you help us understand your gardening needs better, and we can assist you in finding the perfect items.
        </p>
        <h4 class="font-semibold mb-2">Benefits:</h4>
        <ul class="list-disc list-inside mb-4">
            <li>Stay updated on new arrivals that match your interests.</li>
            <li>Receive personalized recommendations.</li>
            <li>Get notified of sales or discounts on your wishlist items.</li>
        </ul>
        <p>
            If you have any questions or need further assistance, feel free to reach out to our support team!
        </p>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@endsection
