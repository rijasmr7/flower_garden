<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage pots</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col">
        <!-- Admin Sidebar -->
        @include('admin.sidebar')

<div class="container mx-auto mt-5">
    <h2 class="text-2xl font-bold">Manage Pots</h2><br><br>

    <!-- Button to add a new pot -->
    <a href="{{ route('admin.pots.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Add New Pot</a>

    <!-- List of pots -->
    <table class="table-auto w-full mt-4">
        <thead>
            <tr>
                <th class="border border-gray-200 p-2">Pot ID</th>
                <th class="border border-gray-200 p-2">Name</th>
                <th class="border border-gray-200 p-2">Price</th>
                <th class="border border-gray-200 p-2">Image</th>
                <th class="border border-gray-200 p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pots as $pot)
            <tr>
                <td class="border border-gray-200 p-2">{{$pot->id }}</td>
                <td class="border border-gray-200 p-2">{{ $pot->name }}</td>
                <td class="border border-gray-200 p-2">{{ $pot->price }}</td>
                <td class="border border-gray-200 p-2"><img src="{{ asset('storage/' . $pot->image) }}" alt="{{ $pot->name }}" width="100"></td>
                <td class="border border-gray-200 p-2">
                    <a href="{{ route('admin.pots.edit', $pot->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-lg">Edit</a>
                    <form action="{{ route('admin.pots.destroy', $pot->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display:inline;">
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
