<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Forgot Password</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

  <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Forgot Your Password?</h2>
    <p class="text-gray-600 text-sm mb-6">
      Enter your email address below and we’ll send you an OTP to reset your password.
    </p>

    <!-- Laravel session success -->
    @if(session('status'))
      <div class="bg-green-100 text-green-800 p-3 rounded mb-4 text-sm">
        {{ session('status') }}
      </div>
    @endif

    <!-- Laravel validation errors -->
    @if($errors->any())
      <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">
        <ul class="list-disc list-inside">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <!-- Email error from JS -->
    <div id="emailError" class="hidden bg-red-100 text-red-700 p-3 rounded mb-4 text-sm"></div>
    

    <form method="POST" action="/verifyEmail" id="forgotPasswordForm">
      @csrf
      <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
        <input type="email" id="email" name="email" autofocus
          class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
      </div>

      <button type="submit"
        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg">
        Verify your email
      </button>
    </form>

    <div class="mt-6 text-center">
      <a href="/navlogin" class="text-sm text-blue-600 hover:underline">
        Back to login
      </a>
    </div>
  </div>

  <!-- JS validation -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const form = document.getElementById('forgotPasswordForm');
      const emailInput = document.getElementById('email');
      const errorBox = document.getElementById('emailError');

      form.addEventListener('submit', function (e) {
        const email = emailInput.value.trim();
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!emailPattern.test(email)) {
          e.preventDefault();
          errorBox.textContent = 'Please enter a valid email address.';
          errorBox.classList.remove('hidden');
          emailInput.focus();
        } else {
          errorBox.classList.add('hidden');
        }
      });
    });
  </script>

</body>
</html>
