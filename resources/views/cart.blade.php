@extends('layout')

@section('title', 'Your Cart')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-semibold mb-6">Your Cart</h1>

    @if ($cartItems->isEmpty())
        <p class="text-gray-600">Your cart is empty.</p>
    @else
        <div class="space-y-6">
            @foreach ($cartItems as $item)
                <div class="flex space-x-4 border-b pb-4">
                    @if ($item->plant)
                        <img src="{{ asset('storage/' . $item->plant->image) }}" alt="{{ $item->plant->name }}" class="h-32 w-32 object-cover rounded-lg">
                        <div>
                            <h2 class="text-xl font-semibold">{{ $item->plant->name }}</h2>
                            <p class="text-gray-600">Rs. {{ $item->plant->price }}</p>
                        </div>
                    @else
                        <p></p>
                    @endif

                    @if ($item->pot)
                        <img src="{{ asset('storage/' . $item->pot->image) }}" alt="{{ $item->pot->name }}" class="h-32 w-32 object-cover rounded-lg">
                        <div>
                            <h2 class="text-xl font-semibold">{{ $item->pot->name }}</h2>
                            <p class="text-gray-600">Rs. {{ $item->pot->price }}</p>
                        </div>
                    @else
                        <p></p>
                    @endif

                    <!-- Remove button -->
                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Remove</button>
                    </form>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
