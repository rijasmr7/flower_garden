<div class="flex min-h-screen">
    <!-- Sidebar (25% width) -->
    <aside class="bg-green-700 text-white w-1/4 min-h-screen py-4 px-6 fixed">
        <h2 class="text-2xl font-semibold mb-6"><a href="/admin">Admin Dashboard</a></h2>
        <nav class="flex flex-col space-y-4">
            <a href="{{ route('admin.users.index') }}" class="hover:bg-green-600 py-2 px-4 rounded">Users</a>
            <a href="{{ route('admin.products') }}" class="hover:bg-green-600 py-2 px-4 rounded">Products</a>
            <a href="{{ route('admin.carts.index') }}" class="hover:bg-green-600 py-2 px-4 rounded">Carts</a>
            <a href="{{ route('admin.orders.index') }}" class="hover:bg-green-600 py-2 px-4 rounded">Orders</a>
            <a href="{{ route('admin.gardenings.index') }}" class="hover:bg-green-600 py-2 px-4 rounded">Gardening</a>
            <a href="{{ route('admin.wishlists.index') }}" class="hover:bg-green-600 py-2 px-4 rounded">Wishlists</a>
            <a href="{{ route('admin.inquiries.index') }}" class="hover:bg-green-600 py-2 px-4 rounded">Inquiries</a>
            <form action="{{ route('adminLogout') }}" method="POST">
                @csrf
                <button type="submit" class="hover:bg-red-600 py-2 px-4 rounded bg-red-500">Logout</button>
            </form>
        </nav>
    </aside>

    <!-- Main Content (75% width) -->
    <div class="w-3/4 ml-[25%] p-6">
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- Yield content from different pages --}}
        @yield('content')
    </div>
</div>
