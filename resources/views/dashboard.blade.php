<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>TeamCollab Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet"/>
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body class="bg-[#f8fafc] text-gray-900 min-h-screen flex">

  <!-- Sidebar -->
  <aside class="w-72 bg-white border-r border-gray-200 flex flex-col justify-between">
    <div>
      <div class="px-6 pt-6 pb-8" style="display:flex; align-items:center; gap:10px">
        <div class="w-10 h-10 rounded overflow-hidden">
        <img
          src="https://sdmntprnorthcentralus.oaiusercontent.com/files/00000000-e454-622f-8e2d-e85930ca57ca/raw?se=2025-05-23T23%3A07%3A44Z&sp=r&sv=2024-08-04&sr=b&scid=0347ee2b-e592-56de-8757-bb7ae920edac&skoid=add8ee7d-5fc7-451e-b06e-a82b2276cf62&sktid=a48cca56-e6da-484e-a814-9c849652bcb3&skt=2025-05-23T13%3A08%3A22Z&ske=2025-05-24T13%3A08%3A22Z&sks=b&skv=2024-08-04&sig=ZNSHIzBDzN2Lx2KqIjOpe73Xih6u5VMqAhbofCEpL/I%3D"
          alt="CollabNest Logo"
          class="w-full h-full object-contain"
        />
      </div>
        <a class="text-indigo-700 font-semibold text-lg" href="#">CollabNest</a>
      </div>
      <div class="px-6 mb-6">
        <div class="flex items-center space-x-4 bg-gray-100 rounded-lg py-3 px-4">
          <img alt="Profile" class="rounded-full w-10 h-10 object-cover" src="https://cdn-icons-png.freepik.com/256/12483/12483554.png?uid=R156815013&ga=GA1.1.1574424695.1745626358&semt=ais_incoming" />
          <div>
            <p class="font-semibold text-gray-900 text-sm leading-tight">John Doe</p>
            <p class="text-gray-500 text-xs leading-tight">john@example.com</p>
          </div>
        </div>
      </div>
    <nav class="flex flex-col space-y-2 px-6 text-gray-900 text-sm font-semibold">
  <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 bg-indigo-100 rounded-md py-2 px-3 text-indigo-700">
    <i class="fas fa-home"></i><span>Dashboard</span>
  </a>

  <a href="{{ route('team') }}" class="flex items-center space-x-2 py-2 px-3 hover:bg-gray-100 rounded-md">
    <i class="fas fa-users"></i><span>Team</span>
  </a>

  <a href="{{ route('projects') }}" class="flex items-center space-x-2 py-2 px-3 hover:bg-gray-100 rounded-md">
    <i class="fas fa-box"></i><span>Projects</span>
  </a>

  <a href="{{ route('tasks') }}" class="flex items-center space-x-2 py-2 px-3 hover:bg-gray-100 rounded-md relative">
    <i class="fas fa-check-square"></i><span>Tasks</span>
    <!-- <span class="absolute right-3 top-2.5 bg-red-600 text-white text-xs font-semibold rounded-full w-5 h-5 flex items-center justify-center">2</span> -->
  </a>

  <a href="{{ route('messages') }}" class="flex items-center space-x-2 py-2 px-3 hover:bg-gray-100 rounded-md">
    <i class="far fa-comment"></i><span>Messages</span>
  </a>

  <a href="{{ route('meetings') }}" class="flex items-center space-x-2 py-2 px-3 hover:bg-gray-100 rounded-md">
    <i class="fas fa-video"></i><span>Meetings</span>
  </a>

  <a href="{{ route('files') }}" class="flex items-center space-x-2 py-2 px-3 hover:bg-gray-100 rounded-md">
    <i class="far fa-file-alt"></i><span>Files</span>
  </a>

  <a href="{{ route('settings') }}" class="flex items-center space-x-2 py-2 px-3 hover:bg-gray-100 rounded-md">
    <i class="fas fa-cog"></i><span>Settings</span>
  </a>
</nav>


    </div>

    <div class="px-6 py-4 border-t border-gray-200">
      <form method="POST" action="/logout">
        @csrf
        <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white text-sm font-semibold py-2 px-4 rounded-lg flex items-center justify-center space-x-2 transition-all duration-200">
          <i class="fas fa-sign-out-alt"></i>
          <span>Logout</span>
        </button>
      </form>
    </div>
  </aside>

  <!-- Main content -->
  <main class="flex-1 p-8">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-xl font-semibold text-gray-900">Welcome, John Doe</h1>
      <button class="bg-indigo-700 text-white text-sm font-semibold px-4 py-2 rounded-md flex items-center space-x-2 hover:bg-indigo-800">
        <i class="fas fa-plus"></i>
        <span>New Project</span>
      </button>
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

    <!-- Recent Projects -->
    <!-- <div class="flex justify-between items-center mb-4">
      <h2 class="font-semibold text-gray-900 text-lg">Recent Projects</h2>
      <a class="text-sm font-semibold text-gray-900 hover:underline" href="#">View All</a>
    </div>
    <div class="bg-white rounded-lg p-6 max-w-md shadow-sm">
      <h3 class="font-semibold text-gray-900 mb-1 text-sm leading-tight">AI-Powered Task Manager</h3>
      <p class="text-gray-500 text-xs mb-4 leading-tight">Building a task management app with AI capabilities to prioritize and suggest…</p>
      <div class="flex justify-between text-gray-600 text-xs mb-3">
        <span>Tasks: <span class="font-semibold">1</span></span>
        <span>Members: <span class="font-semibold">1</span></span>
      </div>
      <img alt="Profile" class="rounded-full w-8 h-8 object-cover" src="https://storage.googleapis.com/a1aa/image/bcb388c1-a959-484f-c78c-12438890ee2a.jpg"/>
    </div> -->
  </main>
</body>
</html>
