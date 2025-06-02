<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>Login Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet"/>
   <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
   <script src="https://unpkg.com/alpinejs" defer></script>
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body>

  <!-- Background container -->
  <div class="relative min-h-screen flex items-center justify-center bg-gradient-to-r from-indigo-500 to-teal-400">
    
    <!-- Background image with opacity -->
    <img alt="People working together" 
         class="absolute inset-0 w-full h-full object-cover opacity-30 pointer-events-none" 
         src="https://storage.googleapis.com/a1aa/image/6a58b975-69ac-4dd7-2152-e73aa1eb888d.jpg" />
    
  <!-- <div class="absolute inset-0 bg-black opacity-40 z-0"></div> -->

    <!-- Login card container (on top) -->
    <div class="relative flex flex-col md:flex-row bg-white rounded-[30px] max-w-4xl w-full shadow-lg overflow-hidden mx-4">
      @if(session('error'))
        <div
            x-data = "{show:true}"
            x-init = "setTimeout(()=>show=false,3000)"
            x-show="show"
            x-transition
            class="bg-red-100 text-red-800 text-center absolute p-3 w-full rounded">
            {{ session('error') }}
        </div>
    @endif
      <!-- Left side: Login form -->
      <div class="flex-1 p-10 md:p-16 flex flex-col justify-center">
        <h2 class="text-black text-xl font-semibold mb-8 text-center md:text-left">Login</h2>
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
            <label class="text-xs text-gray-500 select-none" for="remember">Remember me</label>
          </div>
          <button type="submit" class="w-full bg-gradient-to-r from-indigo-400 to-teal-300 text-white font-semibold text-xs py-3 rounded hover:from-indigo-500 hover:to-teal-400 transition-colors">
            Login
          </button>
        </form>
        <p class="text-center text-xs text-gray-400 mt-8">
          Don't have an account? 
          <a class="text-[#3b56f5] font-semibold hover:underline" href="/register">Sign up</a>
        </p>
      </div>
      
      <!-- Right side: Illustration and text -->
      <div class="flex-1 bg-[#f0f3ff] p-10 md:p-16 flex flex-col items-center justify-center rounded-tl-[30px] rounded-br-[30px]">
        <img alt="Illustration showing hands holding lightbulb and charts representing project progress" class="mb-6 max-w-[240px] w-full bg-[#f0f3ff]" height="200" src="https://img.freepik.com/free-vector/forgot-password-concept-illustration_114360-1123.jpg?t=st=1748026416~exp=1748030016~hmac=bf9b35b39272eacaeed7b4a17a1dbab35a7f194992a1c899376b369eeca6ec08&w=2000" width="240"/>
        <h3 class="text-black font-semibold text-lg mb-2 text-center">Description</h3>
        <p class="text-xs text-gray-400 text-center max-w-xs mb-6">
          Login to access your dashboard, view project updates, track tasks, and collaborate with your team in real time.
        </p>
      </div>
    </div>
  </div>

</body>
</html>
