<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>TeamCollab Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet"/>
  <script src="https://unpkg.com/alpinejs" defer></script>
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>

<body class="bg-[#f8fafc] text-gray-900 min-h-screen flex">
    
  <!-- Sidebar -->
    @include("layout.aside")
  <!-- Main content -->
  <main class="flex-1 p-8">
 @if(session('success'))
        <div
            x-data = "{show:true}"
            x-init = "setTimeout(()=>show=false,3000)"
            x-show="show"
            x-transition
            class="bg-green-100 text-green-800 text-center absolute p-3 rounded" style="width: 500px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-between items-center mb-6">
      <h1 class="text-xl font-semibold text-gray-900">Welcome, {{Auth::user()->name}}</h1>
    
    </div>

    <!-- Stats cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-8">
      <div class="bg-white rounded-lg p-6 flex flex-col space-y-3 shadow-sm">
        <div class="w-10 h-10 bg-indigo-100 rounded-md flex items-center justify-center text-indigo-700"><i class="fas fa-gift"></i></div>
        <p class="text-2xl font-bold leading-none">1</p>
        <p class="text-gray-500 text-xs">Active Projects</p>
      </div>
      <div class="bg-white rounded-lg p-6 flex flex-col space-y-3 shadow-sm">
        <div class="w-10 h-10 bg-teal-100 rounded-md flex items-center justify-center text-teal-700"><i class="fas fa-check-square"></i></div>
        <p class="text-2xl font-bold leading-none">1</p>
        <p class="text-gray-500 text-xs">Tasks Assigned to You</p>
      </div>
      <div class="bg-white rounded-lg p-6 flex flex-col space-y-3 shadow-sm">
        <div class="w-10 h-10 bg-purple-100 rounded-md flex items-center justify-center text-purple-700"><i class="fas fa-user-friends"></i></div>
        <p class="text-2xl font-bold leading-none">1</p>
        <p class="text-gray-500 text-xs">Team Members</p>
      </div>
      <div class="bg-white rounded-lg p-6 flex flex-col space-y-3 shadow-sm">
        <div class="w-10 h-10 bg-orange-100 rounded-md flex items-center justify-center text-orange-700"><i class="far fa-comment"></i></div>
        <p class="text-2xl font-bold leading-none">3</p>
        <p class="text-gray-500 text-xs">Unread Messages</p>
      </div>
    </div>

  </main>
</body>
</html>
