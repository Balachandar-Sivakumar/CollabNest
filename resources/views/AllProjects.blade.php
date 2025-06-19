<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <title>TeamCollab Dashboard</title>
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
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
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
  </style>
</head>

<body class="min-h-screen flex">

  <!-- Sidebar -->
  @include('layout.aside')

  <main class="flex-1 p-6 md:p-8">
    <div class="max-w-7xl mx-auto">
      <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
          <h1 class="text-3xl font-bold text-gray-800">Explore Projects</h1>
          <p class="text-gray-500 mt-1">Browse and join exciting collaboration opportunities</p>
        </div>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($projects as $project)
        @if($project->status !== 2 && $project->is_private !== 1)
        <div class="project-card bg-white rounded-xl shadow-card p-6 hover:shadow-card-hover">
          <!-- Project Image with Gradient Overlay -->
          <div class="relative rounded-lg overflow-hidden mb-5 h-48">
            <img src="{{ asset('storage/'.$project->logo) }}" alt="project image" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900/60 to-transparent"></div>
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
              <span>Skills Needed</span>
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
            $profile = \App\Models\UserProfile::where('user_id',$project->owner_id)->value('profile_settings');
            $image = json_decode($profile,true)['image'] ?? [];
            $name = \App\Models\User::where('id',$project->owner_id)->value('name')
          @endphp
          
          <div class="flex items-center justify-between mt-5 pt-4 border-t border-gray-100">
            <div class="flex items-center">
              <img src="{{ $image ? asset('storage/' . $image) : 'https://ui-avatars.com/api/?name='.urlencode($name).'&background=ebf4ff&color=7f9cf5' }}"
                   alt="Owner photo"
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
        @endif
        @endforeach
      </div>
      
      <!-- Empty State -->
      @if(count($projects) === 0)
      <div class="text-center py-12">
        <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-6">
          <i class="fas fa-folder-open text-3xl text-gray-400"></i>
        </div>
        <h3 class="text-xl font-semibold text-gray-700 mb-2">No Projects Available</h3>
        <p class="text-gray-500 max-w-md mx-auto">There are currently no public projects to display. Check back later or create your own project.</p>
        <button class="mt-6 px-6 py-2.5 bg-primary-500 hover:bg-primary-600 text-white rounded-lg font-medium transition-colors inline-flex items-center gap-2">
          <i class="fas fa-plus"></i>
          <span>Create Project</span>
        </button>
      </div>
      @endif
    </div>
  </main>
</body>
</html>