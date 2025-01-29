<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
  <div class="min-h-screen flex flex-col">
    <!-- Sidebar -->
    <aside class="bg-green-700 text-white w-64 py-4 px-6">
      <h2 class="text-2xl font-semibold mb-6"><a href="/admin">Admin Dashboard</h2></a>
      <nav class="flex flex-col space-y-4">
        <a href="{{ route('admin.users.index') }}" class="admin-dash-nav">Users</a>
        <a href="{{ route('admin.products') }}" class="admin-dash-nav">Products</a>
        <a href="{{ route('admin.carts.index') }}" class="admin-dash-nav">Carts</a>
        <a href="{{ route('admin.orders.index') }}" class="admin-dash-nav">Orders</a>
        <a href="{{ route('admin.gardenings.index') }}" class="admin-dash-nav">Gardening</a>
        <a href="{{ route('admin.wishlists.index') }}" class="admin-dash-nav">Wishlists</a>
        <a href="{{ route('admin.inquiries.index') }}" class="admin-dash-nav">Inquiries</a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="hover:bg-red-600 py-2 px-4 rounded bg-red-500">Logout</button>
        </form>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 bg-white p-6">
      <h1 class="text-3xl font-bold mb-6">Welcome, Admin!</h1>

     
      <section>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          
          <div class="bg-gray-100 p-4 rounded shadow-lg">
            <h3 class="text-xl font-bold mb-2">Manage Users</h3>
            <p class="text-gray-700">View and manage all registered users on the platform.</p>
            <a href="{{ route('admin.users.index') }}" class="mt-4 inline-block text-green-700 hover:text-green-500">View Users</a>
          </div>

          <div class="bg-gray-100 p-4 rounded shadow-lg">
            <h3 class="text-xl font-bold mb-2">Manage Products</h3>
            <p class="text-gray-700">View and manage all products available in the store.</p>
            <a href="{{ route('admin.products') }}" class="mt-4 inline-block text-green-700 hover:text-green-500">View Products</a>
          </div>

          
        </div>
      </section>
    </main>
  </div>
</body>
</html>
