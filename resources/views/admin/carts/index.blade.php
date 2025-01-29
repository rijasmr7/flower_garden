<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage carts</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col">
        <!-- Admin Sidebar -->
        @include('admin.sidebar')

<div class="container mx-auto mt-5">
    <h2 class="text-2xl font-bold">Manage carts</h2><br><br>
    <table class="table-auto w-full mt-4">
        <thead>
            <tr>
                <th class="border border-gray-200 p-2">Cart ID</th>
                <th class="border border-gray-200 p-2">User ID</th>
                <th class="border border-gray-200 p-2">Plant ID</th>
                <th class="border border-gray-200 p-2">Pot ID</th>
                <th class="border border-gray-200 p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($carts as $cart)
            <tr>
                <td class="border border-gray-200 p-2">{{ $cart->id }}</td>
                <td class="border border-gray-200 p-2">{{ $cart->user_id }}</td>
                <td class="border border-gray-200 p-2">{{ $cart->plant_id }}</td>
                <td class="border border-gray-200 p-2">{{ $cart->pot_id }}</td>
                <td class="border border-gray-200 p-2">
                    <form action="{{ route('admin.carts.destroy', $cart->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display:inline;">
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
