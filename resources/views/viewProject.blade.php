<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>{{ $project->title }} | TeamCollab Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
  <style>
    body { font-family: 'Inter', sans-serif; }
    .skill-tag {
      transition: all 0.2s ease;
    }
    .skill-tag:hover {
      transform: translateY(-2px);
      box-shadow: 0 3px 6px rgba(0,0,0,0.15);
    }
  </style>
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex">

  @include('layout.aside')

  <main class="flex-1 px-6 md:px-12 py-10">
    <div class="max-w-5xl mx-auto space-y-10">

      <!-- Header -->
      <div class="flex justify-between items-start flex-wrap gap-4">
        <div>
          
          <h1 class="text-4xl font-bold text-gray-900">{{ $project->title }}</h1>
          <div class="flex items-center mt-2 space-x-4 text-sm text-gray-600">
            <span class="px-3 py-1 rounded-full font-medium 
              {{ $project->is_private ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
              {{ $project->is_private ? 'Private' : 'Public' }}
            </span>
            <span>Owned by <strong>{{ \App\Models\User::where('id',$project->owner_id )->value('name')}}</strong></span>
          </div>
        </div>
        <div class="flex gap-3">
          <a href="{{url()->previous()}}" class="flex items-center px-4 py-2 text-sm bg-white border rounded-md shadow-sm hover:bg-gray-50 text-gray-700">
            <i class="fas fa-arrow-left mr-2"></i> Back
          </a>
          <a href="/navUpdateProject/{{$project->id}}" class="flex items-center px-4 py-2 text-sm text-white bg-indigo-600 rounded-md shadow hover:bg-indigo-700">
            <i class="fas fa-edit mr-2"></i> Edit
          </a>
        </div>
      </div>

      <!-- Project Details Card -->
      <div class="bg-white shadow-xl rounded-lg overflow-hidden border border-gray-200">
       
        <div class="p-8 space-y-10">

          <!-- Description -->
          <section>
            <h2 class="text-xl font-semibold mb-2 flex items-center">
              <i class="fas fa-align-left mr-2 text-indigo-500"></i> Description
            </h2>
            <p class="text-gray-700 leading-relaxed">
              {{ $project->description ?? 'No description provided.' }}
            </p>
          </section>

          <!-- Goals -->
          <section>
            <h2 class="text-xl font-semibold mb-2 flex items-center">
              <i class="fas fa-bullseye mr-2 text-indigo-500"></i> Goals
            </h2>
            <p class="text-gray-700 leading-relaxed">
              {{ $project->goals ?? 'No goals defined.' }}
            </p>
          </section>

          <!-- Grid Sections -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            
            <!-- Skills -->
            <div>
              <h3 class="text-lg font-semibold mb-2 flex items-center">
                <i class="fas fa-tools mr-2 text-indigo-500"></i> Skills Required
              </h3>

              @if($project->skills_required)
                <div class="flex flex-wrap gap-2">
                  @foreach (json_decode($project->skills_required) as $skill)
                    <span class="skill-tag inline-block px-3 py-1 rounded-full text-sm bg-indigo-100 text-indigo-800">
                      {{ App\Models\Skill::where('id',$skill)->value('skill') }}
                    </span>
                  @endforeach
                </div>
              @else
                <p class="text-gray-500 italic">Not specified</p>
              @endif
            </div>


            <!-- GitHub Repo -->
            <div>

            </div>

            <!-- Documents -->
            <div>
              <h3 class="text-lg font-semibold mb-2 flex items-center">
                <i class="fas fa-file-alt mr-2 text-indigo-500"></i> Requirements
              </h3>
              @if($project->requirement_documents)
                <a href="{{ asset('storage/' . $project->requirement_documents) }}" target="_blank"
                   class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm text-gray-700 bg-white hover:bg-gray-50">
                  <i class="fas fa-download mr-2"></i> Download Document
                </a>
              @else
                <p class="text-gray-500 italic">No documents uploaded</p>
              @endif
            </div>


          </div>
        </div>

        <!-- Footer -->
        <div class="bg-gray-50 border-t border-gray-200 px-6 py-4 flex justify-between items-center">
          <span class="text-sm text-gray-500">
            Created on {{ $project->created_at->format('M d, Y') }}
          </span>
          <div class="flex gap-3">
            <button class="flex items-center px-3 py-1.5 text-sm border border-gray-300 rounded-md bg-white text-gray-700 hover:bg-gray-100">
              <i class="fas fa-share-alt mr-2"></i> Share
            </button>
            <button class="flex items-center px-3 py-1.5 text-sm text-white bg-indigo-600 rounded-md hover:bg-indigo-700">
              <i class="fas fa-user-plus mr-2"></i> Request
            </button>
          </div>
        </div>
      </div>

    </div>

    <!-- Add this section right before the closing </div> of your main content (before the max-w-5xl mx-auto space-y-10 closing div) -->

<!-- Tasks Section -->
<div class="bg-white shadow-xl rounded-lg overflow-hidden border border-gray-200">
  <div class="px-6 py-4 border-b border-gray-200">
    <h2 class="text-xl font-semibold flex items-center">
      <i class="fas fa-tasks mr-2 text-indigo-500"></i> Project Tasks
    </h2>
  </div>
  
  <div class="divide-y divide-gray-200">
    <!-- Task Filters -->
    <div class="px-6 py-4 flex flex-wrap items-center justify-between gap-3">
      <a href="{{ route('tasks.create') }}" class="flex items-center px-3 py-1.5 text-sm text-white bg-indigo-600 rounded-md hover:bg-indigo-700">
        <i class="fas fa-plus mr-2"></i> New Task
      </a>

      
    </div>

   
  </main>
</body>
</html>
