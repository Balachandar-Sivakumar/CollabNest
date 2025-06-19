<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>TeamCollab Dashboard - Project Invites</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: {
              50: '#f0f9ff',
              100: '#e0f2fe',
              200: '#bae6fd',
              300: '#7dd3fc',
              400: '#38bdf8',
              500: '#0ea5e9',
              600: '#0284c7',
              700: '#0369a1',
              800: '#075985',
              900: '#0c4a6e',
            },
            secondary: {
              50: '#f5f3ff',
              100: '#ede9fe',
              200: '#ddd6fe',
              300: '#c4b5fd',
              400: '#a78bfa',
              500: '#8b5cf6',
              600: '#7c3aed',
              700: '#6d28d9',
              800: '#5b21b6',
              900: '#4c1d95',
            },
            accent: {
              50: '#f0fdf4',
              100: '#dcfce7',
              200: '#bbf7d0',
              300: '#86efac',
              400: '#4ade80',
              500: '#22c55e',
              600: '#16a34a',
              700: '#15803d',
              800: '#166534',
              900: '#14532d',
            },
            danger: {
              50: '#fef2f2',
              100: '#fee2e2',
              200: '#fecaca',
              300: '#fca5a5',
              400: '#f87171',
              500: '#ef4444',
              600: '#dc2626',
              700: '#b91c1c',
              800: '#991b1b',
              900: '#7f1d1d',
            }
          }
        }
      }
    }
  </script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: radial-gradient(circle at top right, #f0f9ff, #f5f3ff);
    }
    
    .card-gradient {
      background: linear-gradient(145deg, #ffffff, #f8fafc);
    }
    
    .btn-accept {
      background: linear-gradient(135deg, #22c55e, #16a34a);
    }
    
    .btn-decline {
      background: linear-gradient(135deg, #ef4444, #dc2626);
    }
    
    .search-box {
      background: rgba(255, 255, 255, 0.7);
      backdrop-filter: blur(5px);
    }
    
    .invite-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>

<body class="min-h-screen">
  <div id="flash-message" class="fixed top-5 right-5 z-50 hidden px-6 py-3 rounded-xl shadow-xl text-white font-medium transition-all duration-300 transform"></div>

  <div class="flex min-h-screen">
    <!-- Sidebar would be included here -->
  @include('layout.aside')

    <main class="flex-1 p-6 md:p-8">
      <div class="max-w-5xl mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
          <div>
            <h1 class="text-3xl font-bold text-primary-800">Project Invitations</h1>
            <p class="text-secondary-600">Manage your incoming project collaboration requests</p>
          </div>
        </div>

        <div class="bg-white card-gradient rounded-2xl shadow-lg overflow-hidden border border-gray-100">
          @if(count($invites) > 0)
          <ul class="divide-y divide-gray-100">
            @foreach($invites as $invite)
            @if($invite->status === 'pending')
            
            @php
            
            $owner = \App\Models\User::find($invite->user_id);
            $project = \App\Models\Project::find($invite->project_id);
            @endphp
            <li class="p-6 hover:bg-gray-50/50 transition-all duration-300 invite-card">
              <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div class="flex items-center space-x-4">
                
                  <div class="flex-shrink-0 relative">
                    <img class="h-14 w-14 rounded-xl object-cover border-2 border-white shadow" 
                         src="{{ $owner->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode($owner->name).'&background=random' }}" 
                         alt="{{ $owner->name }}">
                    <span class="absolute -bottom-1 -right-1 bg-accent-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">
                      <i class="fas fa-user-plus"></i>
                    </span>
                  </div>
                  <div>
                    <h3 class="text-lg font-semibold text-gray-900">{{ $owner->name }}</h3>
                    <p class="text-gray-600">Invited you to join 
                      <span class="font-semibold text-primary-600 hover:text-primary-700 transition-colors">{{ $project->name ?? 'Project' }}</span>
                    </p>
                    <div class="flex items-center mt-1 text-sm text-secondary-500">
                      <i class="far fa-clock mr-1.5"></i> 
                      <span>{{ $invite->created_at->diffForHumans() }}</span>
                      <span class="mx-2">•</span>
                      <i class="fas fa-project-diagram mr-1.5"></i>
                      <span>{{ $project->members_count ?? 0 }} members</span>
                    </div>
                  </div>
                </div>
                <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                  <button onclick="makeDecision(this, '{{ $invite->project_id }}', 'accept')" 
                          class="px-5 py-2.5 btn-accept hover:bg-accent-600 text-white rounded-xl transition-all duration-200 flex items-center justify-center space-x-2 shadow hover:shadow-md">
                    <i class="fas fa-check"></i>
                    <span>Accept</span>
                  </button>
                  <button onclick="makeDecision(this, '{{ $invite->project_id }}', 'decline')" 
                          class="px-5 py-2.5 btn-decline hover:bg-danger-600 text-white rounded-xl transition-all duration-200 flex items-center justify-center space-x-2 shadow hover:shadow-md">
                    <i class="fas fa-times"></i>
                    <span>Decline</span>
                  </button>
                </div>
              </div>
            </li>
            @endif
            @endforeach
          </ul>
          @else
          <div class="p-12 text-center">
            <div class="mx-auto w-24 h-24 bg-gradient-to-br from-primary-100 to-secondary-100 rounded-2xl flex items-center justify-center mb-6 shadow-inner">
              <i class="fas fa-envelope-open-text text-4xl text-primary-500"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">No pending invitations</h3>
            <p class="text-secondary-500 max-w-md mx-auto">You don't have any project invitations right now. When you receive one, it will appear here.</p>
            <button class="mt-6 px-6 py-2.5 bg-primary-500 hover:bg-primary-600 text-white rounded-xl font-medium transition-colors duration-200 inline-flex items-center space-x-2 shadow">
              <i class="fas fa-plus"></i>
              <span>Create New Project</span>
            </button>
          </div>
          @endif
        </div>
      </div>
    </main>
  </div>

  <script>
    function showMessage(message, type = 'success') {
      const flash = document.getElementById('flash-message');
      flash.innerHTML = `
        <div class="flex items-center space-x-3">
          <i class="${type === 'success' ? 'fas fa-check-circle' : 'fas fa-exclamation-circle'} text-xl"></i>
          <span>${message}</span>
        </div>
      `;
      
      flash.className = `fixed top-5 right-5 z-50 px-6 py-3 rounded-xl shadow-xl text-white font-medium transition-all duration-300 transform ${
        type === 'success' ? 'bg-accent-500' : 'bg-danger-500'
      } flex items-center`;
      
      flash.style.display = 'flex';
      setTimeout(() => {
        flash.style.opacity = '0';
        flash.style.transform = 'translateX(20px)';
        setTimeout(() => {
          flash.style.display = 'none';
          flash.style.opacity = '1';
          flash.style.transform = 'translateX(0)';
        }, 300);
      }, 3000);
    }

    function makeDecision(button, projectId, action) {
      const card = button.closest('li');
      if (card) {
        card.style.opacity = '0';
        card.style.transform = 'translateX(20px)';
        setTimeout(() => card.remove(), 300);
      }

      fetch('/decision', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify({
            name: action,
            project_id: projectId
          })
        })
        .then(res => res.json())
        .then(data => {
          if (action === 'accept') {
            showMessage(`You've joined the project successfully!` ,
               'success' 
            );
          } else {
            showMessage('Invitaion Declined','error')
          }
        })
        .catch(err => {
          console.error('Error:', err);
          showMessage(err.error || 'Something went wrong', 'error');
        });
    }
  </script>
</body>

</html>