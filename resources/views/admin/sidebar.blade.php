<aside class="bg-green-700 text-white w-64 py-4 px-6">
    <h2 class="text-2xl font-semibold mb-6"><a href="/admin">Admin Dashboard</h2></a>
    <nav class="flex flex-col space-y-4">
        <a href="{{ route('admin.users.index') }}" class="hover:bg-green-600 py-2 px-4 rounded">Users</a>
        <a href="{{ route('admin.products') }}" class="hover:bg-green-600 py-2 px-4 rounded">Products</a>
        <a href="{{ route('admin.carts.index') }}" class="hover:bg-green-600 py-2 px-4 rounded">Carts</a>
        <a href="{{ route('admin.orders.index') }}" class="hover:bg-green-600 py-2 px-4 rounded">Orders</a>
        <a href="{{ route('admin.gardenings.index') }}" class="hover:bg-green-600 py-2 px-4 rounded">Gardening</a>
        <a href="{{ route('admin.wishlists.index') }}" class="hover:bg-green-600 py-2 px-4 rounded">Wishlists</a>
        <a href="{{ route('admin.inquiries.index') }}" class="hover:bg-green-600 py-2 px-4 rounded">Inquiries</a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="hover:bg-red-600 py-2 px-4 rounded bg-red-500">Logout</button>
        </form>
    </nav>
</aside>
<div>
            @if (session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
</div>