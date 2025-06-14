<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <title>{{ $project->title }} | TeamCollab Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
<<<<<<< HEAD
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
   <script src="//unpkg.com/alpinejs" defer></script>
=======
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
>>>>>>> origin/dev
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }

    .skill-tag {
      transition: all 0.2s ease;
    }

    .skill-tag:hover {
      transform: translateY(-2px);
      box-shadow: 0 3px 6px rgba(0, 0, 0, 0.15);
    }
  </style>
</head>
@if(session('success'))
  <div id="toast"
       class="fixed bottom-5 right-5 z-50 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg animate-slide-in">
    <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
  </div>

  <script>
    // Auto-dismiss after 2 minutes (120,000ms)
    setTimeout(() => {
      const toast = document.getElementById('toast');
      if (toast) toast.style.display = 'none';
    }, 120000); // 2 minutes = 120000 ms
  </script>

  <style>
    @keyframes slide-in {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .animate-slide-in {
      animation: slide-in 0.5s ease-out;
    }
  </style>
@endif


<body class="bg-gray-100 text-gray-800 min-h-screen flex">

  @include('layout.aside')

  <main class="flex-1  h-screen overflow-y-auto p-6">
    <div class="max-w-5xl mx-auto space-y-10">

      <!-- Header -->
      <div class="flex justify-between items-start flex-wrap gap-4">
        <div>
<<<<<<< HEAD
=======

>>>>>>> origin/dev
          <h1 class="text-4xl font-bold text-gray-900">{{ $project->title }}</h1>
          <div class="flex items-center mt-2 space-x-4 text-sm text-gray-600">
            <span class="px-3 py-1 rounded-full font-medium 
              {{ $project->is_private ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
              {{ $project->is_private ? 'Private' : 'Public' }}
            </span>
            <span>Owned by <strong>{{ \App\Models\User::where('id',$project->owner_id)->value('name') }}</strong></span>
          </div>
        </div>
        <div class="flex gap-3">
          <a href="{{ url()->previous() }}" class="flex items-center px-4 py-2 text-sm bg-white border rounded-md shadow-sm hover:bg-gray-50 text-gray-700">
            <i class="fas fa-arrow-left mr-2"></i> Back
          </a>
<<<<<<< HEAD
          <a href="/navUpdateProject/{{ $project->id }}" class="flex items-center px-4 py-2 text-sm text-white bg-indigo-600 rounded-md shadow hover:bg-indigo-700">
=======
          @if($project->owner_id === Auth::user()->id)
          <a href="/navUpdateProject/{{$project->id}}" class="flex items-center px-4 py-2 text-sm text-white bg-indigo-600 rounded-md shadow hover:bg-indigo-700">
>>>>>>> origin/dev
            <i class="fas fa-edit mr-2"></i> Edit
          </a>
          @endif
        </div>
      </div>

      <!-- Project Details Card -->
      <div class="bg-white shadow-xl rounded-lg overflow-hidden border border-gray-200">
<<<<<<< HEAD
=======

>>>>>>> origin/dev
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
<<<<<<< HEAD
              @if($project->skills_required && json_decode($project->skills_required))
                <div class="flex flex-wrap gap-2">
                  @foreach(json_decode($project->skills_required) as $skill)
                    @php
                      $skillName = \App\Models\Skill::where('id', $skill)->value('skill');
                    @endphp
                    @if($skillName)
                      <span class="skill-tag inline-block px-3 py-1 rounded-full text-sm bg-indigo-100 text-indigo-800">
                        {{ $skillName }}
                      </span>
                    @endif
                  @endforeach
                </div>
=======

              @if($project->skills_required)
              <div class="flex flex-wrap gap-2">
                @foreach (json_decode($project->skills_required) as $skill)
                <span class="skill-tag inline-block px-3 py-1 rounded-full text-sm bg-indigo-100 text-indigo-800">
                  {{ App\Models\Skill::where('id',$skill)->value('skill') }}
                </span>
                @endforeach
              </div>
>>>>>>> origin/dev
              @else
              <p class="text-gray-500 italic">Not specified</p>
              @endif
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
            <form action="{{ route('request', ['project' => $project->id]) }}" method="POST">
    @csrf
  @if($project->owner_id !== Auth::user()->id)
    <a href="{{ route('request', ['project' => $project->id]) }}"
       class="flex items-center px-3 py-1.5 text-sm text-white bg-indigo-600 rounded-md hover:bg-indigo-700">
       <i class="fas fa-user-plus mr-2"></i> Request
    </a>
@endif


          </div>
        </div>
      </div>

      <!-- Tasks Section -->
      <div class="bg-white shadow-xl rounded-lg overflow-hidden border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
          <h2 class="text-xl font-semibold flex items-center">
            <i class="fas fa-tasks mr-2 text-indigo-500"></i> Project Tasks
          </h2>
        </div>
        
       <div class="container mx-auto px-4 py-8">
    <div class="flex justify-center">
        <div class="w-full">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="bg-gray-800 text-white px-6 py-4">
                    <h2 class="text-xl font-semibold">Tasks</h2>
                </div>

                <div class="p-6">
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mb-6">
                  <a href="{{ route('tasks.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Create New Task
                        </a>
                    </div>

                    <h4 class="text-lg font-semibold mb-4">Tasks Assigned by Me</h4>
                    @if($assignedTasks->isEmpty())
                        <p class="text-gray-600">No tasks assigned by you.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="py-2 px-4 border-b border-gray-200 text-left">Title</th>
                                        <th class="py-2 px-4 border-b border-gray-200 text-left">Assigned To</th>
                                        <th class="py-2 px-4 border-b border-gray-200 text-left">Due Date</th>
                                        <th class="py-2 px-4 border-b border-gray-200 text-left">Status</th>
                                        <th class="py-2 px-4 border-b border-gray-200 text-left">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($assignedTasks as $task)
                                        <tr class="hover:bg-gray-50">
                                            <td class="py-2 px-4 border-b border-gray-200">{{ $task->title }}</td>
                                            <td class="py-2 px-4 border-b border-gray-200">{{ $task->assignee->name }}</td>
                                            <td class="py-2 px-4 border-b border-gray-200">{{ $task->due_date ? $task->due_date->format('Y-m-d') : 'N/A' }}</td>
                                            <td class="py-2 px-4 border-b border-gray-200">
    <div class="relative" x-data="{ open: false }">
        <span
            @click="open = !open"
            class="px-2 py-1 rounded text-xs font-semibold cursor-pointer {{ $statusClasses[$task->status] ?? '' }}"
        >
            {{ ucfirst(str_replace('_', ' ', $task->status)) }}
        </span>
        <div
            x-show="open"
            @click.away="open = false"
            class="absolute left-0 mt-1 w-32 bg-white border rounded shadow-lg z-10"
            x-transition
        >
            <form method="POST" action="{{ route('tasks.update', $task) }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="title" value="{{ $task->title }}">
                <input type="hidden" name="description" value="{{ $task->description }}">
                <input type="hidden" name="assigned_to" value="{{ $task->assigned_to }}">
                <input type="hidden" name="due_date" value="{{ $task->due_date }}">
                <button type="submit" name="status" value="pending" class="block w-full text-left px-4 py-2 text-yellow-700 hover:bg-yellow-100 {{ $task->status == 'pending' ? 'font-bold' : '' }}">Pending</button>
                <button type="submit" name="status" value="in_progress" class="block w-full text-left px-4 py-2 text-blue-700 hover:bg-blue-100 {{ $task->status == 'in_progress' ? 'font-bold' : '' }}">In Progress</button>
                <button type="submit" name="status" value="completed" class="block w-full text-left px-4 py-2 text-green-700 hover:bg-green-100 {{ $task->status == 'completed' ? 'font-bold' : '' }}">Completed</button>
            </form>
        </div>
    </div>
</td>
                                            <td class="py-2 px-4 border-b border-gray-200 space-x-2">
                                                <a href="{{ route('tasks.show', $task) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-sm">View</a>
                                                <a href="{{ route('tasks.edit', $task) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded text-sm">Edit</a>
                                                <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    <h4 class="text-lg font-semibold mt-8 mb-4">Tasks Assigned to Me</h4>
                    @if($receivedTasks->isEmpty())
                        <p class="text-gray-600">No tasks assigned to you.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="py-2 px-4 border-b border-gray-200 text-left">Title</th>
                                        <th class="py-2 px-4 border-b border-gray-200 text-left">Assigned By</th>
                                        <th class="py-2 px-4 border-b border-gray-200 text-left">Due Date</th>
                                        <th class="py-2 px-4 border-b border-gray-200 text-left">Status</th>
                                        <th class="py-2 px-4 border-b border-gray-200 text-left">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($receivedTasks as $task)
                                        <tr class="hover:bg-gray-50">
                                            <td class="py-2 px-4 border-b border-gray-200">{{ $task->title }}</td>
                                            <td class="py-2 px-4 border-b border-gray-200">{{ $task->assigner->name }}</td>
                                            <td class="py-2 px-4 border-b border-gray-200">{{ $task->due_date ? $task->due_date->format('Y-m-d') : 'N/A' }}</td>
                                            <td class="py-2 px-4 border-b border-gray-200">
                                                <div class="relative" x-data="{ open: false }">
        <span
            @click="open = !open"
            class="px-2 py-1 rounded text-xs font-semibold cursor-pointer {{ $statusClasses[$task->status] ?? '' }}"
        >
            {{ ucfirst(str_replace('_', ' ', $task->status)) }}
        </span>
        <div
            x-show="open"
            @click.away="open = false"
            class="absolute left-0 mt-1 w-32 bg-white border rounded shadow-lg z-10"
            x-transition
        >
            <form method="POST" action="{{ route('tasks.update', $task) }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="title" value="{{ $task->title }}">
                <input type="hidden" name="description" value="{{ $task->description }}">
                <input type="hidden" name="assigned_to" value="{{ $task->assigned_to }}">
                <input type="hidden" name="due_date" value="{{ $task->due_date }}">
                <button type="submit" name="status" value="pending" class="block w-full text-left px-4 py-2 text-yellow-700 hover:bg-yellow-100 {{ $task->status == 'pending' ? 'font-bold' : '' }}">Pending</button>
                <button type="submit" name="status" value="in_progress" class="block w-full text-left px-4 py-2 text-blue-700 hover:bg-blue-100 {{ $task->status == 'in_progress' ? 'font-bold' : '' }}">In Progress</button>
                <button type="submit" name="status" value="completed" class="block w-full text-left px-4 py-2 text-green-700 hover:bg-green-100 {{ $task->status == 'completed' ? 'font-bold' : '' }}">Completed</button>
            </form>
        </div>
    </div>
                                            </td>
                                            <td class="py-2 px-4 border-b border-gray-200">
                                                <a href="{{ route('tasks.show', $task) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-sm">View</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
  </main>
</body>
<<<<<<< HEAD
=======

>>>>>>> origin/dev
</html>