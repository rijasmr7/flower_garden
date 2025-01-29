<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    @vite('resources/css/app.css')
    <script>
        function confirmDeletion(event) {
            if (!confirm('Are you sure you want to delete this user?')) {
                event.preventDefault();
            }
        }
    </script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col">
        <!-- Admin Sidebar -->
        @include('admin.sidebar')

        <!-- Main Content -->
        <main class="flex-1 bg-white p-6">
            <h1 class="text-3xl font-bold mb-6">Users</h1>


            <div class="mb-6">
                <a href="{{ route('admin.users.create') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Add New User</a>
            </div>

            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr>
                        <th class="border border-gray-200 p-2">User ID</th>
                        <th class="border border-gray-200 p-2">Name</th>
                        <th class="border border-gray-200 p-2">Email</th>
                        <th class="border border-gray-200 p-2">City</th>
                        <th class="border border-gray-200 p-2">Role</th>
                        <th class="border border-gray-200 p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td class="border border-gray-200 p-2">{{$user->id }}</td>
                        <td class="border border-gray-200 p-2">{{ $user->name }}</td>
                        <td class="border border-gray-200 p-2">{{ $user->email }}</td>
                        <td class="border border-gray-200 p-2">{{ $user->city }}</td>
                        <td class="border border-gray-200 p-2">{{ $user->role }}</td>
                        <td class="border border-gray-200 p-2">
                            <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-500 hover:underline">Edit</a>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline" onsubmit="confirmDeletion(event)">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>
