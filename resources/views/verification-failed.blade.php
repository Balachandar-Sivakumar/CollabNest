<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verification Failed</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-xl rounded-2xl p-8 max-w-md w-full text-center">
        <h2 class="text-2xl font-bold text-red-600 mb-4">Verification Failed</h2>
        <p class="text-gray-700 mb-6">{{ $message }}</p>
        <a href="/register" class="inline-block bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
            Try Again
        </a>
    </div>

</body>
</html>

