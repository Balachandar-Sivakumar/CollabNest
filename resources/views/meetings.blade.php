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
      <div class="px-6 pt-6 pb-8">
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
  <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 py-2 px-3 hover:bg-gray-100 rounded-md">
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

  <a href="{{ route('meetings') }}"class="flex items-center space-x-2 bg-indigo-100 rounded-md py-2 px-3 text-indigo-700">
    <i class="fas fa-video"></i><span>Meetings</span>
  </a>

  <a href="{{ route('files') }}" class="flex items-center space-x-2 py-2 px-3 hover:bg-gray-100 rounded-md">
    <i class="far fa-file-alt"></i><span>Files</span>
  </a>

  <a href="{{ route('settings') }}" class="flex items-center space-x-2 py-2 px-3 hover:bg-gray-100 rounded-md">
    <i class="fas fa-cog"></i><span>Settings</span>
  </a>
</nav>


  
</body>
</html>
