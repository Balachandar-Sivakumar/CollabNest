<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Email Verification</title>
</head>
<body class="bg-gray-100 py-10 px-4">
    <div class="max-w-xl mx-auto bg-white rounded-xl shadow-md overflow-hidden">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-4">
            <h1 class="text-white text-xl font-bold">Verify Your Email Address</h1>
        </div>
        <div class="p-6">
            <p class="text-gray-800 text-lg font-semibold mb-2">Hello, {{ $user->name }} 👋</p>
            <p class="text-gray-600 mb-4">
                Thank you for registering! To complete your registration, please verify your email address by clicking the button below.
            </p>

            <div class="text-center my-6">
                <a href="{{ $url }}"
                   class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-6 py-3 rounded-full shadow transition duration-300">
                    ✅ Verify My Email
                </a>
            </div>

            <p class="text-gray-500 text-sm mt-6">
                If you did not create an account, no further action is required.
            </p>
        </div>
        <div class="bg-gray-100 text-center text-xs text-gray-500 py-3">
            &copy; {{ date('Y') }} Collabnest. All rights reserved.
        </div>
    </div>
</body>
</html>

