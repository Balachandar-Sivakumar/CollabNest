<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>My Projects | TeamCollab</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: {
              50: '#f0f9ff',
              100: '#e0f2fe',
              500: '#3b82f6',
              600: '#2563eb',
              700: '#1d4ed8',
            },
            secondary: {
              50: '#f5f3ff',
              100: '#ede9fe',
              500: '#8b5cf6',
              600: '#7c3aed',
            },
            accent: {
              50: '#ecfdf5',
              100: '#d1fae5',
              500: '#10b981',
              600: '#059669',
            }
          },
          boxShadow: {
            'card': '0 4px 20px rgba(0, 0, 0, 0.08)',
            'card-hover': '0 8px 25px rgba(0, 0, 0, 0.12)'
          }
        }
      }
    }
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    }
    
    .project-card {
      transition: all 0.3s ease;
      border: 1px solid rgba(226, 232, 240, 0.6);
    }
    
    .project-card:hover {
      transform: translateY(-5px);
    }
    
    .skill-tag {
      transition: all 0.2s ease;
    }
    
    .skill-tag:hover {
      transform: translateY(-1px);
    }
    
    /* Custom scrollbar */
    ::-webkit-scrollbar {
      width: 8px;
    }
    ::-webkit-scrollbar-track {
      background: #f1f1f1;
    }
    ::-webkit-scrollbar-thumb {
      background: #cbd5e1;
      border-radius: 4px;
    }
    ::-webkit-scrollbar-thumb:hover {
      background: #94a3b8;
    }
  </style>
</head>

<body class="min-h-screen flex">

  <!-- Sidebar -->
  @include('layout.aside')

  <main class="flex-1 h-screen overflow-y-auto p-6 md:p-8">

    <!-- Success Notification -->
    @if(session('success'))
    <div
      x-data="{show:true}"
      x-init="setTimeout(()=>show=false,3000)"
      x-show="show"
      x-transition
      class="fixed top-6 left-1/2 transform -translate-x-1/2 z-50 bg-emerald-50 text-emerald-700 text-sm px-6 py-3 rounded-lg border border-emerald-200 flex items-center gap-2 shadow-lg">
      <i class="fas fa-check-circle text-emerald-500"></i>
      {{ session('success') }}
      <button @click="show = false" class="ml-4 text-emerald-600 hover:text-emerald-800">
        <i class="fas fa-times"></i>
      </button>
    </div>
    @endif

    <div class="max-w-7xl mx-auto">
      <!-- Header -->
      <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
          <h1 class="text-3xl font-bold text-gray-800">My Projects</h1>
          <p class="text-gray-500 mt-1">Manage your active collaborations</p>
        </div>
        <a href="/navcreateproject" 
           class="bg-primary-500 hover:bg-primary-600 text-white px-5 py-2.5 rounded-lg shadow-md transition-colors flex items-center gap-2">
          <i class="fas fa-plus"></i>
          <span>Create New Project</span>
        </a>
      </div>

      <!-- Projects Grid -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($projects as $project)
        <div class="project-card bg-white rounded-xl shadow-card p-6 hover:shadow-card-hover">
          <!-- Project Image -->
          <div class="relative rounded-lg overflow-hidden mb-5 h-48 bg-gray-100">
            <img src="{{ asset('storage/'.$project->logo) }}" 
                 alt="{{ $project->title }}" 
                 class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900/40 to-transparent"></div>
            <div class="absolute bottom-4 left-4">
              <h2 class="text-xl font-bold text-white">{{ $project->title }}</h2>
            </div>
          </div>

          <!-- Project Description -->
          <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $project->description }}</p>

          <!-- Skills -->
          <div class="mb-4">
            <div class="flex items-center text-sm text-gray-500 mb-2">
              <i class="fas fa-tools mr-2"></i>
              <span>Skills Required</span>
            </div>
            <div class="flex flex-wrap gap-2">
              @foreach(json_decode($project->skills_required) as $skill)
                <span class="skill-tag bg-primary-100 text-primary-700 text-xs px-3 py-1.5 rounded-full font-medium">
                  {{ \App\Models\Skill::where('id', $skill)->value('skill') }}
                </span>
              @endforeach
            </div>
          </div>

          <!-- Owner Info -->
          @php 
            $profile = \App\Models\UserProfile::where('user_id', Auth::user()->id)->value('profile_settings');
            $image = json_decode($profile,true)['image'] ?? [];
            $name = \App\Models\User::where('id', Auth::user()->id)->value('name');
          @endphp
          
          <div class="flex items-center justify-between mt-5 pt-4 border-t border-gray-100">
            <div class="flex items-center">
              <img src="{{ $image ? asset('storage/' . $image) : 'https://ui-avatars.com/api/?name='.urlencode($name).'&background=ebf4ff&color=7f9cf5' }}"
                   alt="{{ $name }}"
                   class="w-10 h-10 rounded-full object-cover mr-3 border-2 border-white shadow-sm">
              <div>
                <span class="block text-xs text-gray-500">Project Owner</span>
                <span class="text-sm font-medium text-gray-700">{{ $name }}</span>
              </div>
            </div>
            
            <!-- View Button -->
            <a href="/view/{{ $project->hashid }}" 
               class="flex items-center justify-center px-4 py-2 bg-primary-500 hover:bg-primary-600 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
              <span>View</span>
              <i class="fas fa-chevron-right ml-2 text-xs"></i>
            </a>
          </div>
        </div>
        @endforeach
      </div>
      
      <!-- Empty State -->
      @if(count($projects) === 0)
      <div class="text-center py-16">
        <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-6">
          <i class="fas fa-folder-open text-3xl text-gray-400"></i>
        </div>
        <h3 class="text-xl font-semibold text-gray-700 mb-2">No Projects Yet</h3>
        <p class="text-gray-500 max-w-md mx-auto mb-6">You haven't created any projects yet. Start collaborating by creating your first project.</p>
        <a href="/navcreateproject" 
           class="inline-flex items-center px-6 py-2.5 bg-primary-500 hover:bg-primary-600 text-white rounded-lg font-medium transition-colors gap-2">
          <i class="fas fa-plus"></i>
          <span>Create Project</span>
        </a>
      </div>
      @endif
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html>