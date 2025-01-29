<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage products</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col">
        <!-- Admin Sidebar -->
        @include('admin.sidebar')
<div class="container mx-auto mt-5">
    <h2 class="text-2xl font-bold">Manage Products</h2>

    <div class="mt-4 flex space-x-4">
        
        <a href="{{ route('admin.plants.index') }}" class="bg-green-500 text-white px-4 py-2 rounded-lg">Plants</a>
        
        
        <a href="{{ route('admin.pots.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Pots</a>
    </div>
</div>
    </div>
</body>
</html>

