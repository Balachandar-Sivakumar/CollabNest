<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>TeamCollab Dashboard - Project Invites</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>
<body class="bg-gray-50 text-gray-900 min-h-screen flex">

  <!-- Sidebar - Preserved as original -->
  @include('layout.aside')

  <!-- Main Content -->
  <main class="flex-1 p-8">
    <div class="max-w-4xl mx-auto">
      <!-- Header -->
      <div class="flex justify-between items-center mb-8">
        <div>
          <h1 class="text-2xl font-bold text-gray-800">Project Invitations</h1>
          <p class="text-gray-500">Manage your incoming project collaboration requests</p>
        </div>
        <div class="relative">
          <input type="text" placeholder="Search invites..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
          <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
        </div>
      </div>

      <!-- Invites List -->
      <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        @if(count($invites) > 0)
          <ul class="divide-y divide-gray-200">
            @foreach($invites as $invite)
              @php
                $owner = \App\Models\User::find($invite->owner_id);
                $project = \App\Models\Project::find($invite->project_id);
              @endphp
              <li class="p-6 hover:bg-gray-50 transition-colors duration-150">
                <div class="flex items-center justify-between">
                  <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                      <img class="h-12 w-12 rounded-full object-cover" src="{{ $owner->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode($owner->name).'&background=random' }}" alt="{{ $owner->name }}">
                    </div>
                    <div>
                      <h3 class="text-lg font-medium text-gray-900">{{ $owner->name }}</h3>
                      <p class="text-gray-600">Invited you to join <span class="font-semibold text-blue-600">{{ $project->name ?? 'Project' }}</span></p>
                      <p class="text-sm text-gray-500 mt-1">
                        <i class="far fa-clock mr-1"></i> {{ $invite->created_at->diffForHumans() }}
                      </p>
                    </div>
                  </div>
                  <div class="flex space-x-3">
                    <button class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors duration-200 flex items-center space-x-2">
                      <i class="fas fa-check"></i>
                      <span>Accept</span>
                    </button>
                    <button class="px-4 py-2 bg-white hover:bg-gray-100 text-gray-700 border border-gray-300 rounded-lg transition-colors duration-200 flex items-center space-x-2">
                      <i class="fas fa-times"></i>
                      <span>Decline</span>
                    </button>
                  </div>
                </div>
              </li>
            @endforeach
          </ul>
        @else
          <div class="p-12 text-center">
            <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
              <i class="fas fa-envelope-open-text text-3xl text-gray-400"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-1">No pending invitations</h3>
            <p class="text-gray-500">You don't have any project invitations at this time.</p>
          </div>
        @endif
      </div>

    </div>
  </main>

  <script>
    // You can add JavaScript interactions here
    $(document).ready(function() {
      // Example: Confirm before declining
      $('button:contains("Decline")').click(function(e) {
        if(!confirm('Are you sure you want to decline this invitation?')) {
          e.preventDefault();
        }
      });
    });
  </script>
</body>
</html>