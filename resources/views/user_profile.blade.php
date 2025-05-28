

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
   <!-- User Card -->
@foreach($users as $user)
  <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
    <img class="w-full h-40 object-cover" src="https://randomuser.me/api/portraits/men/32.jpg" alt="User Photo" />
    <div class="p-4">
      <h2 class="text-xl font-semibold text-gray-800">{{ $user->name }}</h2>

      @php
        $userSkill = $skills->where('user_id', $user->id)->first();
      @endphp

      <p class="text-gray-500 text-sm mt-1">{{ $userSkill->profession ?? 'N/A' }}</p>

      <div class="flex flex-wrap mt-3 gap-2">
        @if($userSkill)
          @foreach(json_decode($userSkill->skills, true) as $n)
            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">{{ $n }}</span>
          @endforeach
        @endif
      </div>
    </div>
  </div>
@endforeach

  </div>
 
</div>

</body>
</html>