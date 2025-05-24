<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Page Not Found - 404</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom bounce animation for the number */
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
        .bounce {
            animation: bounce 2s infinite;
        }
    </style>
</head>
<body class="bg-gradient-to-r from-indigo-500 to-teal-400 min-h-screen flex items-center justify-center">
    <div class="bg-white bg-opacity-90 rounded-lg shadow-lg p-10 max-w-md mx-auto text-center">
         <!-- <img alt="People working together" class="absolute inset-0 w-full h-full object-cover opacity-30"
       src="https://storage.googleapis.com/a1aa/image/6a58b975-69ac-4dd7-2152-e73aa1eb888d.jpg"/> -->
        <h1 class="text-9xl font-extrabold text-purple-700 bounce">404</h1>
        <p class="text-2xl md:text-3xl font-semibold mt-6 mb-4 text-gray-700">
            Oops! Page not found.
        </p>
        <p class="text-gray-600 mb-8">
            Sorry, the page you are looking for could not be found.
        </p>
        <a href="{{ url('/') }}" 
           class="inline-block px-6 py-3 bg-purple-600 text-white font-semibold rounded hover:bg-purple-700 transition duration-300">
           Go to Dashboard
        </a>
    </div>
</body>
</html>
