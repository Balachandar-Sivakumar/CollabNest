<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   Login Page
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&amp;display=swap" rel="stylesheet"/>
  <style>
   body {
      font-family: 'Inter', sans-serif;
    }
  </style>
 </head>
 <body class="bg-[#a7b8ff] min-h-screen flex items-center justify-center p-4">
  <div class="flex flex-col md:flex-row bg-white rounded-[30px] max-w-4xl w-full shadow-lg overflow-hidden">
   <!-- Left side: Login form -->
   <div class="flex-1 p-10 md:p-16 flex flex-col justify-center">
    <h2 class="text-black text-xl font-semibold mb-8 text-center md:text-left">
     Login
    </h2>
    <form class="space-y-6" method="POST" action="/login">
        @csrf
     <div>
      <input class="w-full bg-[#f0f0f0] rounded-lg py-3 px-4 text-sm text-gray-500 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#3b56f5]" name="email" placeholder="Username or email" type="text"/>
     </div>
     <div class="relative">
      <input class="w-full bg-[#f0f0f0] rounded-lg py-3 px-4 text-sm text-gray-500 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#3b56f5]" name="password" placeholder="Password" type="password"/>
      <button class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 text-xs font-semibold" type="button">
       Forgot password ?
      </button>
     </div>
     <div class="flex items-center space-x-2">
      <input class="w-4 h-4 rounded border-gray-300 text-[#3b56f5] focus:ring-[#3b56f5]" id="remember" type="checkbox"/>
      <label class="text-xs text-gray-500 select-none" for="remember">
       Remember me
      </label>
     </div>
     <button type="submit" class="w-full bg-[#3b56f5] text-white rounded-lg py-3 text-sm font-semibold hover:bg-[#2a3edb] transition-colors" type="submit">
      Login
     </button>
    </form>
    <p class="text-center text-xs text-gray-400 mt-8">
     Don't have an account ?
     <a class="text-[#3b56f5] font-semibold hover:underline" href="/register">
      Sign up
     </a>
    </p>
   </div>
   <!-- Right side: Illustration and text -->
   <div class="flex-1 bg-[#f0f3ff] p-10 md:p-16 flex flex-col items-center justify-center rounded-tr-[30px] rounded-br-[30px]">
    <img alt="Illustration showing hands holding lightbulb and charts representing project progress" class="mb-6 max-w-[240px] w-full" height="200" src="https://storage.googleapis.com/a1aa/image/8f740317-4da6-46ec-4445-87f78d430e71.jpg" width="240"/>
    <h3 class="text-black font-semibold text-lg mb-2 text-center">
     Check Your Project Progress
    </h3>
    <p class="text-xs text-gray-400 text-center max-w-xs mb-6">
     Lorem ipsum dolor sit amet tristique urna, lorem sed pellentesque
        doloremque sit amet ipsum.
    </p>
    
    </div>
   </div>
  </div>
 </body>
</html>
