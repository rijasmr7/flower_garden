<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage inquiries</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col">
        <!-- Admin Sidebar -->
        @include('admin.sidebar')

<div class="container mx-auto mt-5">
    <h2 class="text-2xl font-bold">Manage inquiries</h2><br><br>
    
    <table class="table-auto w-full mt-4">
        <thead>
            <tr>
                <th class="border border-gray-200 p-2">Inquiry ID</th>
                <th class="border border-gray-200 p-2">User ID</th>
                <th class="border border-gray-200 p-2">Name</th>
                <th class="border border-gray-200 p-2">phone</th>
                <th class="border border-gray-200 p-2">Address</th>
                <th class="border border-gray-200 p-2">Message</th>
                <th class="border border-gray-200 p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inquiries as $inquiry)
            <tr>
                <td class="border border-gray-200 p-2">{{ $inquiry->id }}</td>
                <td class="border border-gray-200 p-2">{{ $inquiry->user_id }}</td>
                <td class="border border-gray-200 p-2">{{ $inquiry->name }}</td>
                <td class="border border-gray-200 p-2">{{ $inquiry->phone }}</td>
                <td class="border border-gray-200 p-2">{{ $inquiry->address }}</td>
                <td class="border border-gray-200 p-2">{{ $inquiry->message }}</td>
                <td class="border border-gray-200 p-2">
                    <form action="{{ route('admin.inquiries.destroy', $inquiry->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display:inline;">
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
