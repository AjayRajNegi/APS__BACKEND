<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Logout</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- @vite('resources/css/app.css') --}}
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="w-full max-w-sm bg-white shadow-md rounded px-8 py-6 text-center">
        <h2 class="text-2xl font-bold mb-4">Logout</h2>
        <p class="mb-6">Are you sure you want to logout?</p>

        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" 
                    class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                Yes, Logout
            </button>
        </form>
    </div>

</body>
</html>

