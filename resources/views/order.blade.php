@extends('layout')

@section('title', 'Order - ' . ($plant ? $plant->name : $pot->name))

@section('content')
<div class="container mx-auto py-8 flex space-x-8">
   
    <div class="w-1/2 bg-white p-8 shadow-lg rounded-lg">
        <h2 class="text-2xl font-semibold mb-6">Order Information</h2>
        <form action="{{ route('order.process') }}" method="POST">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="first_name" class="block text-sm font-medium">First Name</label>
                    <input type="text" name="first_name" id="first_name" class="mt-1 block w-full rounded-md border-gray-300">
                </div>
                <div>
                    <label for="last_name" class="block text-sm font-medium">Last Name</label>
                    <input type="text" name="last_name" id="last_name" class="mt-1 block w-full rounded-md border-gray-300">
                </div>
                <div>
                    <label for="phone" class="block text-sm font-medium">Phone Number</label>
                    <input type="tel" name="phone" id="phone" class="mt-1 block w-full rounded-md border-gray-300">
                </div>
                <div class="col-span-2">
                    <label for="address" class="block text-sm font-medium">Address</label>
                    <input type="text" name="address" id="address" class="mt-1 block w-full rounded-md border-gray-300">
                </div>
                <div>
                    <label for="city" class="block text-sm font-medium">City</label>
                    <input type="text" name="city" id="city" class="mt-1 block w-full rounded-md border-gray-300">
                </div>
                <div>
                    <label for="province" class="block text-sm font-medium">Province</label>
                    <input type="text" name="province" id="province" class="mt-1 block w-full rounded-md border-gray-300">
                </div>
                <div>
                    <label for="district" class="block text-sm font-medium">District</label>
                    <input type="text" name="district" id="district" class="mt-1 block w-full rounded-md border-gray-300">
                </div>
                <div>
                    <label for="postal_code" class="block text-sm font-medium">Postal Code</label>
                    <input type="text" name="postal_code" id="postal_code" class="mt-1 block w-full rounded-md border-gray-300">
                </div>
            </div>
       
        <div class="mt-4">
            <label for="quantity" class="block text-sm font-medium">Quantity</label>
            <input type="number" id="quantity" name="quantity" value="1" min="1" class="mt-1 block w-20 rounded-md border-gray-300" onchange="updateTotal()">
        </div>
            <input type="hidden" name="plant_id" value="{{ $plant->id ?? '' }}">
            <input type="hidden" name="pot_id" value="{{ $pot->id ?? '' }}">

            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded mt-4">Proceed</button>
        </form>
    </div>

    
    <div class="w-1/2 bg-white p-8 shadow-lg rounded-lg">
        <h2 class="text-2xl font-semibold mb-6">Product Details</h2>

        @if(isset($plant))
            <!-- Plant Details -->
            <div class="flex items-center mb-4">
                <img src="{{ asset('storage/' . $plant->image) }}" alt="{{ $plant->name }}" class="h-32 w-32 object-cover rounded-lg mr-4">
                <div>
                    <h3 class="text-xl font-semibold">{{ $plant->name }}</h3>
                    <p class="text-gray-600">{{ ucfirst($plant->size) }} size</p>
                    <p class="text-gray-600">{{ $plant->leave_color }} leaves</p>
                    <p class="text-gray-600">Rs. {{ $plant->price }}</p>
                </div>
            </div>
            <div class="mt-4">
                <p class="text-sm">Unit Price: Rs. <span id="unit_price">{{ $plant->price }}</span></p>
                <p class="text-sm">Quantity: <span id="quantity_selected">1</span></p>
                <p class="text-lg font-semibold mt-2">Total Amount: Rs. <span id="total_amount">{{ $plant->price }}</span></p>
            </div>
        @elseif(isset($pot))
            <!-- Pot Details -->
            <div class="flex items-center mb-4">
                <img src="{{ asset('storage/' . $pot->image) }}" alt="{{ $pot->name }}" class="h-32 w-32 object-cover rounded-lg mr-4">
                <div>
                    <h3 class="text-xl font-semibold">{{ $pot->name }}</h3>
                    <p class="text-gray-600">Size: {{ ucfirst($pot->size) }}</p>
                    <p class="text-gray-600">Rs. {{ $pot->price }}</p>
                </div>
            </div>
            <div class="mt-4">
                <p class="text-sm">Unit Price: Rs. <span id="unit_price">{{ $pot->price }}</span></p>
                <p class="text-sm">Quantity: <span id="quantity_selected">1</span></p>
                <p class="text-lg font-semibold mt-2">Total Amount: Rs. <span id="total_amount">{{ $pot->price }}</span></p>
            </div>
        @else
            <p class="text-red-600">No product selected.</p>
        @endif
    </div>
</div>

<script>
    function updateTotal() {
        const quantity = document.getElementById('quantity').value;
        const unitPrice = {{ isset($plant) ? $plant->price : $pot->price }};
        const totalAmount = quantity * unitPrice;
        document.getElementById('quantity_selected').innerText = quantity;
        document.getElementById('total_amount').innerText = totalAmount;
    }
</script>
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
           

