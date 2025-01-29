@extends('layout')

@section('title', $pot->name)

@section('content')
<div class="container mx-auto py-8">
    <div class="flex space-x-4">
        <img src="{{ asset('storage/' . $pot->image) }}" alt="{{ $pot->name }}" class="h-96 w-96 object-cover rounded-lg">
        <div>
            <h1 class="text-4xl font-semibold mb-4">{{ $pot->name }}</h1>
            <p class="text-gray-600 text-xl mb-4">Rs. {{ $pot->price }}</p>
            <p class="text-gray-600 mb-2">{{ ucfirst($pot->size) }} size</p>
            <p class="text-gray-600 mb-2">{{ $pot->pot_color }} color</p>
            <p class="text-gray-600 mb-4">{{ $pot->description }}</p>
            
            <p class="{{ $pot->is_available ? 'text-green-500' : 'text-red-500' }}">
                {{ $pot->is_available ? 'In stock' : 'Arrives soon' }}
            </p>

            @if (Auth::check())
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="pot_id" value="{{ $pot->id }}">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded mt-4">
                        Add to Cart
                    </button>
                </form>
                <form action="{{ route('order.show', $pot->id) }}" method="GET">
                    @csrf
                    <input type="hidden" name="pot_id" value="{{ $pot->id }}">
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded mt-4">
                        Make Order
                    </button>
                </form>
            @else
                <p class="text-red-500 mt-4">Please <a href="{{ route('login') }}" class="text-blue-500">login</a> or <a href="{{ route('register') }}" class="text-blue-500">register</a> to add to cart or place an order.</p>
            @endif
            
        </div>
    </div>
</div>
@endsection
