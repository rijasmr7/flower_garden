<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add plants</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col">
        <!-- Admin Sidebar -->
        @include('admin.sidebar')

<h1 class="text-2xl font-bold mb-4">Add Plant</h1>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<form action="{{ route('admin.plants.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-4">
        <label for="name" class="block text-gray-700">Name:</label>
        <input type="text" name="name" id="name" class="w-full border rounded px-3 py-2" required>
    </div>

    <div class="mb-4">
        <label for="price" class="block text-gray-700">Price:</label>
        <input type="text" name="price" id="price" class="w-full border rounded px-3 py-2" required>
    </div>

    <div class="mb-4">
        <label for="size" class="block text-gray-700">Size:</label>
        <input type="text" name="size" id="size" class="w-full border rounded px-3 py-2" required>
    </div>

    <div class="mb-4">
        <label for="description" class="block text-gray-700">Description:</label>
        <input type="text" name="description" id="description" class="w-full border rounded px-3 py-2" required>
    </div>

    <div class="mb-4">
        <label for="category" class="block text-gray-700">Category:</label>
        <label for="indoor">Indoor</label>
        <input type="radio" id="indoor" name="category" value="indoor"><br>
        <label for="outdoor">Outdoor</label>
        <input type="radio" id="outdoor" name="category" value="outdoor">
    </div>

    <div class="mb-4">
        <label for="quantity" class="block text-gray-700">Quantity:</label>
        <input type="text" name="quantity" id="quantity" class="w-full border rounded px-3 py-2" required>
    </div>

    <div class="mb-4">
        <label for="leave_color" class="block text-gray-700">Leave color:</label>
        <input type="text" name="leave_color" id="leave_color" class="w-full border rounded px-3 py-2" required>
    </div>

    <div class="mb-4">
        <label for="is_available" class="block text-gray-700">Is available:</label>
        <label for="yes">Yes</label>
        <input type="radio" id="yes" name="is_available" value="1"><br>
        <label for="no">No</label>
        <input type="radio" id="no" name="is_available" value="0">
    </div>

    <div class="mb-4">
        <label for="purchased_date" class="block text-gray-700">Purchased date:</label>
        <input type="date" name="purchased_date" id="purchased_date" class="w-full border rounded px-3 py-2" required>
    </div>

    <div class="mb-4">
        <label for="image" class="block text-gray-700">Upload Image:</label>
        <input type="file" name="image" id="image" class="w-full border rounded px-3 py-2">
    </div>

    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Add Plant</button>
</form>
</div>
</body>
</html>
