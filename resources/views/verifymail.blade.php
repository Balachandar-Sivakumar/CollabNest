<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Email Verification</title>
</head>
<body class="bg-gray-100 py-10 px-4">
    <div class="max-w-xl mx-auto bg-white rounded-xl shadow-md overflow-hidden">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-4">
            <h1 class="text-white text-xl font-bold">Verify Your Email Address</h1>
        </div>
        <div class="p-6">
            <p>Hello, {{ $user->name ?? 'User' }} 👋</p>
            <p>Thank you for registering! Please verify your email address:</p>

            <div style="text-align: center; margin: 24px 0;">
                <a href="{{ url('/verify') . '?token=' . $token . '&email_hash=' . $hash }}"
                style="display: inline-block; background-color: #2563EB; color: #ffffff; padding: 12px 24px; font-size: 14px; font-weight: bold; text-decoration: none; border-radius: 6px;">
                    ✅ Verify My Email
                </a>
            </div>

            <p style="font-size: 14px; color: #555;">
                Or paste this link in your browser:<br>
                <a href="{{ url('/verify') . '?token=' . $token . '&email_hash=' . $hash }}" style="color: #2563EB;">{{ url('/verify') . '?token=' . $token . '&email_hash=' . $hash }}</a>
            </p>
        <div class="bg-gray-100 text-center text-xs text-gray-500 py-3">
            &copy; {{ date('Y') }} Collabnest. All rights reserved.
        </div>
    </div>
</body>
</html>

