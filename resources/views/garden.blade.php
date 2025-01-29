@extends('layout')

@section('title', 'Gardening Services')

@section('content')

<div class="container mx-auto py-8">
    <div class="flex flex-col lg:flex-row space-y-8 lg:space-y-0 lg:space-x-8">
       
        <div class="w-full lg:w-1/2 bg-white p-8 shadow-lg rounded-lg">
            <h2 class="text-3xl font-bold mb-6 text-green-600">Book Your Gardening Service</h2>
            <form action="{{ route('gardening.apply') }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label for="customer_name" class="block text-lg font-medium text-gray-700">Customer Name</label>
                    <input type="text" name="customer_name" id="customer_name" placeholder="Your Name" required class="mt-1 block w-full p-3 rounded-md border border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500">
                </div>

                
                <div class="mb-4">
                    <label for="phone" class="block text-lg font-medium text-gray-700">Phone Number</label>
                    <input type="tel" name="phone" id="phone" placeholder="Your Phone Number" required class="mt-1 block w-full p-3 rounded-md border border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500">
                </div>

                
                <div class="mb-4">
                    <label for="address" class="block text-lg font-medium text-gray-700">Address</label>
                    <input type="text" name="address" id="address" placeholder="Your Address" required class="mt-1 block w-full p-3 rounded-md border border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500">
                </div>

                
                <div class="mb-4">
                    <label for="gardening_date" class="block text-lg font-medium text-gray-700">Date of Gardening</label>
                    <input type="date" name="gardening_date" id="gardening_date" required class="mt-1 block w-full p-3 rounded-md border border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500">
                </div>

                
                @if (Auth::check())
                <div class="mt-6">
                    <button type="submit" class="w-full bg-green-600 text-white font-semibold py-3 rounded-md hover:bg-green-700 transition ease-in-out duration-300">
                        Apply for Gardening
                    </button>
                </div>
                @else
                    <p class="text-red-500 mt-4">Please <a href="{{ route('login') }}" class="text-blue-500">login</a> or <a href="{{ route('register') }}" class="text-blue-500">register</a> to apply for gardening services.</p>
                @endif
            </form>
        </div>

        
        <div class="w-full lg:w-1/2 bg-green-100 p-8 shadow-lg rounded-lg flex flex-col items-center justify-center">
            <h2 class="text-3xl font-bold mb-4 text-green-600">Transform Your Garden Today!</h2>
            <p class="text-gray-700 text-lg mb-6 text-center">
                Our expert gardening team is here to help you create and maintain a beautiful garden. Fill out the form to get started, and we'll take care of the rest!
            </p>
            <img src="{{ asset('images/gardening.jpeg') }}" alt="Gardening Service" class="rounded-lg shadow-lg">
        </div>
    </div>
</div>
@endsection
