<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update pots</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col">
        <!-- Admin Sidebar -->
        @include('admin.sidebar')
<h1 class="text-2xl font-bold mb-4">Edit Pot</h1>

<form action="{{ route('admin.pots.update', $pot->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT') 

    <div class="mb-4">
        <label for="name" class="block text-gray-700">Name:</label>
        <input type="text" name="name" id="name" value="{{ old('name', $pot->name) }}" class="w-full border rounded px-3 py-2" required>
    </div>

    <div class="mb-4">
        <label for="price" class="block text-gray-700">Price:</label>
        <input type="text" name="price" id="price" value="{{ old('price', $pot->price) }}" class="w-full border rounded px-3 py-2" required>
    </div>

    <div class="mb-4">
        <label for="size" class="block text-gray-700">Size:</label>
        <input type="text" name="size" id="size" value="{{ old('size', $pot->size) }}" class="w-full border rounded px-3 py-2" required>
    </div>

    <div class="mb-4">
        <label for="description" class="block text-gray-700">Description:</label>
        <input type="text" name="description" id="description" value="{{ old('description', $pot->description) }}" class="w-full border rounded px-3 py-2" required>
    </div>

    <div class="mb-4">
        <label for="category" class="block text-gray-700">Category:</label>
        <label for="plastic">Plastic</label>
        <input type="radio" id="plastic" name="category" value="plastic" {{ $pot->category == 'plastic' ? 'checked' : '' }}>
        <label for="cement">Cement</label>
        <input type="radio" id="cement" name="category" value="cement" {{ $pot->category == 'cement' ? 'checked' : '' }}>
    </div>

    <div class="mb-4">
        <label for="quantity" class="block text-gray-700">Quantity:</label>
        <input type="text" name="quantity" id="quantity" value="{{ old('quantity', $pot->quantity) }}" class="w-full border rounded px-3 py-2" required>
    </div>

    <div class="mb-4">
        <label for="pot_color" class="block text-gray-700">Pot color:</label>
        <input type="text" name="pot_color" id="pot_color" value="{{ old('pot_color', $pot->pot_color) }}" class="w-full border rounded px-3 py-2" required>
    </div>

    <div class="mb-4">
        <label for="is_available" class="block text-gray-700">Is available:</label>
        <label for="yes">Yes</label>
        <input type="radio" id="yes" name="is_available" value="1" {{ $pot->is_available == '1' ? 'checked' : '' }}>
        <label for="no">No</label>
        <input type="radio" id="no" name="is_available" value="0" {{ $pot->is_available == '0' ? 'checked' : '' }}>
    </div>

    <div class="mb-4">
        <label for="purchased_date" class="block text-gray-700">Purchased date:</label>
        <input type="date" name="purchased_date" id="purchased_date" value="{{ old('purchased_date', $pot->purchased_date) }}" class="w-full border rounded px-3 py-2" required>
    </div>

    <div class="mb-4">
        <label for="image" class="block text-gray-700">Upload New Image:</label>
        <input type="file" name="image" id="image" class="w-full border rounded px-3 py-2">
        
        @if ($pot->image)
            <div class="mt-2">
                <p>Current Image:</p>
                <img src="{{ asset('storage/' . $pot->image) }}" alt="{{ $pot->name }}" width="100">
            </div>
        @endif
    </div>

    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Update Pot</button>
</form>
    </div>
</body>

</html>
