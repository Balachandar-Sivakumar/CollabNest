<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>Create Account</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet"/>
   <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
       body {
    font-family: 'Inter', sans-serif;
  }
  </style>
</head>
<body>
  <div class="relative min-h-screen flex items-center justify-center bg-gradient-to-r from-indigo-500 to-teal-400">
    <!-- Background Image -->
    <img alt="People working together" class="absolute inset-0 w-full h-full object-cover opacity-30"
         src="https://storage.googleapis.com/a1aa/image/6a58b975-69ac-4dd7-2152-e73aa1eb888d.jpg"/>


  <!-- <div class="absolute inset-0 bg-black opacity-40 z-0"></div> -->

    <!-- Two-column layout -->
 <div class="relative z-10 max-w-4xl w-full shadow-lg  bg-white flex flex-col md:flex-row rounded-[30px]">
      
      <!-- Left side: Illustration and text -->
      <div class="flex-1 bg-[#f0f3ff] p-10 md:p-16 flex flex-col items-center justify-center rounded-tl-[30px] rounded-bl-[30px]">
        <img alt="Illustration showing hands holding lightbulb and charts representing project progress"
             class="mb-6 max-w-[240px] w-full"
             src="https://img.freepik.com/free-vector/privacy-policy-concept-illustration_114360-7853.jpg?uid=R156815013&ga=GA1.1.1574424695.1745626358&semt=ais_hybrid&w=740" width="240" height="200"/>
        <h3 class="text-black font-semibold text-lg mb-2 text-center">Description</h3>
        <p class="text-xs text-gray-400 text-center max-w-xs mb-6">
          Create an account to showcase your skills, connect with collaborators, and bring your ideas to life with real-time project tracking and collaboration tools.
        </p>
      </div>

      <!-- Right side: Create account form -->
      <div class="flex-1 p-10 md:p-16 flex flex-col justify-center">
        <form method="POST" action="/step_one" class="w-full max-w-md mx-auto">
          @csrf
          <h2 class="text-center text-black text-lg font-extrabold mb-8">Create Account</h2>

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
    </div>
  </div>
</body>
</html>
