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

  <main class="flex-1 p-6">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-semibold">My Projects</h1>
      <a href="/navcreateproject" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-md transition">
        <i class="fas fa-plus mr-2"></i> Create New Project
      </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">



    @foreach($projects as $project)
      <!-- Project Card 1 -->
      <div class="bg-white rounded-xl shadow-md p-5 hover:shadow-lg transition">
        <h2 class="text-xl font-bold text-gray-800 mb-2">{{$project->title}}</h2>
        <p class="text-gray-600 text-sm mb-3">{{$project->description}}</p>
        <div class="mb-2">
          <strong class="text-sm">Skills:</strong>
          <div class="flex flex-wrap mt-1">
            @foreach(json_decode($project->skills_required) as $skill)
            <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded mr-2 mb-1">{{$skill}}</span>
           @endforeach
          </div>
        </div>
        <a href="/view/{{$project->id}}" class="text-blue-600 text-sm hover:underline">View Details</a>
      </div>
    @endforeach


    </div>
  </main>
</body>
</html>
