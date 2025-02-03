<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
<div class="flex min-h-screen">
        <div class="w-1/4 min-h-screen">
            @include('admin.sidebar')
        </div>

        <div class="w-3/4 p-6">
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
