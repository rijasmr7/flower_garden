<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col">
        <!-- Admin Sidebar -->
        @include('admin.sidebar')

        <!-- Main Content -->
        <main class="flex-1 bg-white p-6">
            <h1 class="text-3xl font-bold mb-6">Add New User</h1>

            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Name</label>
                    <input type="text" name="name" id="name" class="form-input mt-1 block w-full" required>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email</label>
                    <input type="email" name="email" id="email" class="form-input mt-1 block w-full" required>
                </div>

                <div class="mb-4">
                    <label for="city" class="block text-gray-700">City</label>
                    <input type="text" name="city" id="city" class="form-input mt-1 block w-full" required>
                </div>

                <div class="mb-4">
                    <label for="role" class="block text-gray-700">Role</label>
                    <input type="text" name="role" id="role" class="form-input mt-1 block w-full" required>
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700">Password</label>
                    <input type="password" name="password" id="password" class="form-input mt-1 block w-full" required>
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="block text-gray-700">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-input mt-1 block w-full" required>
                </div>

                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Add User</button>
            </form>
        </main>
    </div>
</body>
</html>
