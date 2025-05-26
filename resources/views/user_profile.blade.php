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
  @include('layout.aside')
  
<div class="p-6 bg-gray-100 min-h-screen">
  <h1 class="text-3xl font-bold mb-6">Our Skilled Users</h1>
 
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 max-h-screen overflow-y-auto scrollbar-hide">
 
    <!-- User Card -->
      @foreach($users as $user)
    <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
      <img class="w-full h-40 object-cover" src="https://randomuser.me/api/portraits/men/32.jpg" alt="User Photo" />
      <div class="p-4">
        <h2 class="text-xl font-semibold text-gray-800">{{$user->name}}</h2>
       
        <p class="text-gray-500 text-sm mt-1">FrontEnd</p>
      
        <div class="flex flex-wrap mt-3 gap-2">
          <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">HTML</span>
          <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">CSS</span>
          <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded">JS</span>
        </div>
        <p class="text-gray-600 text-sm mt-3">Passionate about building responsive UIs and creating seamless user experiences.</p>
      </div>
    </div>
 @endforeach
    <!-- Repeat the User Card block for each user -->
  </div>
 
</div>

  
</body>
</html>