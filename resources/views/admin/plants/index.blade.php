<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage plants</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col">
        <!-- Admin Sidebar -->
        @include('admin.sidebar')

<div class="container mx-auto mt-5">
    <h2 class="text-2xl font-bold">Manage Plants</h2><br><br>

    <!-- Button to add a new plant -->
    <a href="{{ route('admin.plants.create') }}" class="bg-green-500 text-white px-4 py-2 rounded-lg">Add New Plant</a>

    <!-- List of plants -->
    <table class="table-auto w-full mt-4">
        <thead>
            <tr>
                <th class="border border-gray-200 p-2">Plant ID</th>
                <th class="border border-gray-200 p-2">Name</th>
                <th class="border border-gray-200 p-2">Price</th>
                <th class="border border-gray-200 p-2">Image</th>
                <th class="border border-gray-200 p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($plants as $plant)
            <tr>
                <td class="border border-gray-200 p-2">{{$plant->id }}</td>
                <td class="border border-gray-200 p-2">{{ $plant->name }}</td>
                <td class="border border-gray-200 p-2">{{ $plant->price }}</td>
                <td class="border border-gray-200 p-2">
            @if ($plant->image)
                <img src="{{ asset('storage/' . $plant->image) }}" alt="{{ $plant->name }}" width="100">
            @else
                No image
            @endif
        </td>
                <td class="border border-gray-200 p-2">
                    <a href="{{ route('admin.plants.edit', $plant->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-lg">Edit</a>
                    <form action="{{ route('admin.plants.destroy', $plant->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display:inline;">
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
