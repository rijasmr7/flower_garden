<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage orders</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col">
        <!-- Admin Sidebar -->
        @include('admin.sidebar')

<div class="container mx-auto mt-5">
    <h2 class="text-2xl font-bold">Manage orders</h2><br><br>
    
    <table class="table-auto w-full mt-4">
        <thead>
            <tr>
                <th class="border border-gray-200 p-2">Order ID</th>
                <th class="border border-gray-200 p-2">Customer ID</th>
                <th class="border border-gray-200 p-2">Plant ID</th>
                <th class="border border-gray-200 p-2">Pot ID</th>
                <th class="border border-gray-200 p-2">Quantity</th>
                <th class="border border-gray-200 p-2">Unit price</th>
                <th class="border border-gray-200 p-2">Total Amount</th>
                <th class="border border-gray-200 p-2">Ordered Date</th>
                <th class="border border-gray-200 p-2">Delivery date</th>
                <th class="border border-gray-200 p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <td class="border border-gray-200 p-2">{{ $order->id }}</td>
                <td class="border border-gray-200 p-2">{{ $order->customer_id }}</td>
                <td class="border border-gray-200 p-2">{{ $order->plant_id }}</td>
                <td class="border border-gray-200 p-2">{{ $order->pot_id }}</td>
                <td class="border border-gray-200 p-2">{{ $order->quantity }}</td>
                <td class="border border-gray-200 p-2">{{ $order->unit_price }}</td>
                <td class="border border-gray-200 p-2">{{ $order->total_amount }}</td>
                <td class="border border-gray-200 p-2">{{ $order->ordered_date }}</td>
                <td class="border border-gray-200 p-2">{{ $order->delivery_date }}</td>
                <td class="border border-gray-200 p-2">
                    <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
</body>
</html>
