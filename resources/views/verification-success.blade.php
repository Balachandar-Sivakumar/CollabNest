<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Check Your Email</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-xl rounded-2xl p-8 max-w-md w-full text-center">
        <h2 class="text-2xl font-bold text-blue-600 mb-4">📬 Email Sent!</h2>
        <p class="text-gray-700 mb-6">A verification email has been sent to <strong>{{ $user->email }}</strong>. Please check your inbox and click the link to verify your email address.</p>
        <button onclick="redirectToEmailProvider('{{ $user->email }}')" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
            Open Email
        </button>
    </div>

    <script>
        function redirectToEmailProvider(email) {

            const redirectUrl = 'https://mail.google.com' ;

            window.open(redirectUrl, '_blank');
        }
    </script>

</body>
</html>

