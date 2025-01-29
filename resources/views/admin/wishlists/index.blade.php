<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage wishlists</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col">
        <!-- Admin Sidebar -->
        @include('admin.sidebar')

<div class="container mx-auto mt-5">
    <h2 class="text-2xl font-bold">Manage wishlists</h2><br><br>

    

   
    <table class="table-auto w-full mt-4">
        <thead>
            <tr>
                <th class="border border-gray-200 p-2">Wishlist ID</th>
                <th class="border border-gray-200 p-2">User ID</th>
                <th class="border border-gray-200 p-2">Customer name</th>
                <th class="border border-gray-200 p-2">Phone</th>
                <th class="border border-gray-200 p-2">Product name</th>
                <th class="border border-gray-200 p-2">Product specification</th>
                <th class="border border-gray-200 p-2">Image</th>
                <th class="border border-gray-200 p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($wishlists as $wishlist)
            <tr>
                <td class="border border-gray-200 p-2">{{$wishlist->id }}</td>
                <td class="border border-gray-200 p-2">{{$wishlist->user_id }}</td>
                <td class="border border-gray-200 p-2">{{$wishlist->customer_name }}</td>
                <td class="border border-gray-200 p-2">{{$wishlist->phone }}</td>
                <td class="border border-gray-200 p-2">{{$wishlist->product_name }}</td>
                <td class="border border-gray-200 p-2">{{$wishlist->product_specification }}</td>
                <td class="border border-gray-200 p-2">
            @if ($wishlist->image)
                <img src="{{ asset('storage/' . $wishlist->image) }}" alt="{{ $wishlist->product_name }}" width="100">
            @else
                No image
            @endif
                </td>
                <td class="border border-gray-200 p-2">
                    <form action="{{ route('admin.wishlists.destroy', $wishlist->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display:inline;">
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
