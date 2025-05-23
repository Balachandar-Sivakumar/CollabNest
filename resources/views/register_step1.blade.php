<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>Create Account</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet"/>
  <style>
    body {
      font-family: 'Montserrat', sans-serif;
    }
  </style>
</head>
<body>
<div class="relative min-h-screen flex items-center justify-center bg-gradient-to-r from-indigo-500 to-teal-400">
  <img alt="People working together" class="absolute inset-0 w-full h-full object-cover opacity-30"
       src="https://storage.googleapis.com/a1aa/image/6a58b975-69ac-4dd7-2152-e73aa1eb888d.jpg"/>

  <form method="POST" action="/step_one"
        class="relative bg-white rounded-lg p-10 w-full max-w-md drop-shadow-lg">
    @csrf

    <h2 class="text-center text-black text-lg font-extrabold mb-8">CREATE ACCOUNT</h2>

    <input name="name" value="{{ old('name') }}"
           class="w-full border border-gray-300 rounded @error('name')border-red-500 @enderror px-3 py-2 mb-2 text-sm text-black focus:outline-none focus:ring-1 focus:ring-cyan-400"
           type="text" placeholder="Full Name"/>
    @error('name')
    <p class="text-red-500 text-xs mb-2">{{ $message }}</p>
    @enderror

    <input name="email" value="{{ old('email') }}"
           class="w-full border border-gray-300 rounded px-3 py-2 mb-2 text-sm text-black focus:outline-none focus:ring-1 focus:ring-cyan-400"
           type="email" placeholder="Your Email"/>
    @error('email')
    <p class="text-red-500 text-xs mb-2">{{ $message }}</p>
    @enderror

    <input name="password"
           class="w-full border border-gray-300 rounded px-3 py-2 mb-2 text-sm text-black focus:outline-none focus:ring-1 focus:ring-cyan-400"
           type="password" placeholder="Password"/>
    @error('password')
    <p class="text-red-500 text-xs mb-2">{{ $message }}</p>
    @enderror

    <input name="password_confirmation"
           class="w-full border border-gray-300 rounded px-3 py-2 mb-4 text-sm text-black focus:outline-none focus:ring-1 focus:ring-cyan-400"
           type="password" placeholder="Repeat your password"/>

    <label class="flex items-center text-xs text-gray-600 mb-6">
      <input class="mr-2 w-4 h-4 border border-gray-300 rounded" type="checkbox" required/>
      <span>I agree to the </span>
      <a class="ml-1 underline text-gray-700 hover:text-cyan-600" href="#">Terms of Service</a>
    </label>

    <button type="submit"
            class="w-full bg-gradient-to-r from-indigo-400 to-teal-300 text-white font-semibold text-xs py-3 rounded hover:from-indigo-500 hover:to-teal-400 transition-colors">
      Next
    </button>

    <p class="text-center text-xs text-gray-700 mt-8 font-normal">
      Already have an account?
      <a class="font-extrabold underline" href="/navlogin">Login here</a>
    </p>
  </form>
</div>
</body>
</html>
