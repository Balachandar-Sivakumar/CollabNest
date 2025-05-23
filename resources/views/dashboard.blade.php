<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white shadow-md rounded-xl p-8 max-w-md w-full text-center">
        <h1 class="text-3xl font-bold mb-4">Welcome, {{ Auth::user()->name }}!</h1>
        <p class="text-gray-600 mb-6">You have successfully logged in.</p>

        <form method="POST" action="/logout">
            @csrf
            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold px-6 py-2 rounded-xl">
                Logout
            </button>
        </form>
    </div>

</body>
</html>
