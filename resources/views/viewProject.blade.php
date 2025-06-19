<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ $project->title }} | TeamCollab</title>
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
            },
            secondary: {
              50: '#f5f3ff',
              100: '#ede9fe',
              500: '#8b5cf6',
            },
            accent: {
              50: '#ecfdf5',
              100: '#d1fae5',
              500: '#10b981',
            },
            danger: {
              50: '#fef2f2',
              100: '#fee2e2',
              500: '#ef4444',
              600: '#dc2626',
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
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    }
    .skill-tag {
      transition: all 0.2s ease;
    }
    .skill-tag:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .document-btn {
      transition: all 0.2s ease;
    }
    .document-btn:hover {
      transform: translateY(-1px);
    }
    .animate-fade-in {
      animation: fadeIn 0.3s ease-out;
    }
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }
    .animate-slide-up {
      animation: slideUp 0.3s ease-out;
    }
    @keyframes slideUp {
      from { transform: translateY(20px); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }
  </style>
</head>

<body class="min-h-screen flex">
  <!-- Success Toast Notification -->
  @if(session('success'))
  <div id="toast" class="fixed bottom-5 right-5 z-50 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg flex items-center animate-slide-up">
    <i class="fas fa-check-circle mr-2"></i> 
    <span>{{ session('success') }}</span>
    <button onclick="document.getElementById('toast').remove()" class="ml-4 text-white hover:text-gray-200">
      <i class="fas fa-times"></i>
    </button>
  </div>
  <script>
    setTimeout(() => {
      const toast = document.getElementById('toast');
      if (toast) toast.remove();
    }, 5000);
  </script>
  @endif

  @include('layout.aside')

  <main class="flex-1 h-screen overflow-y-auto p-6 md:p-8">
    <div class="max-w-6xl mx-auto space-y-8">

      <!-- Project Header -->
      <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <div>
          <div class="flex items-center gap-4">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900">{{ $project->title }}</h1>
            <span class="px-3 py-1 rounded-full text-sm font-medium 
              {{ $project->is_private ? 'bg-secondary-100 text-secondary-800' : 'bg-primary-100 text-primary-800' }}">
              {{ $project->is_private ? 'Private' : 'Public' }}
            </span>
          </div>
          
          <div class="flex items-center mt-3 gap-4 text-sm text-gray-600">
            <div class="flex items-center">
              <i class="fas fa-user-circle mr-2 text-gray-500"></i>
              <span>Owned by <strong class="text-gray-700">{{ \App\Models\User::where('id',$project->owner_id)->value('name') }}</strong></span>
            </div>
            <div class="flex items-center">
              <i class="fas fa-calendar-alt mr-2 text-gray-500"></i>
              <span>Created {{ $project->created_at->format('M d, Y') }}</span>
            </div>
          </div>
        </div>

        <div class="flex flex-wrap gap-3">
          <a href="{{ url()->previous() }}" class="flex items-center px-4 py-2.5 text-sm bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-50 text-gray-700 transition">
            <i class="fas fa-arrow-left mr-2"></i> Back
          </a>

          @if($project->owner_id === Auth::user()->id)
          <a href="/navUpdateProject/{{$project->id}}" class="flex items-center px-4 py-2.5 text-sm text-white bg-primary-600 rounded-lg shadow hover:bg-primary-700 transition">
            <i class="fas fa-edit mr-2"></i> Edit Project
          </a>
          @endif
        </div>
      </div>

      <!-- Project Status Badge -->
      <div class="flex items-center gap-3">
        <span class="px-3 py-1 rounded-full text-sm font-medium 
          @if($project->status == 0) bg-yellow-100 text-yellow-800
          @elseif($project->status == 1) bg-accent-100 text-accent-800
          @else bg-gray-100 text-gray-800
          @endif">
          <i class="fas 
            @if($project->status == 0) fa-lock-open
            @elseif($project->status == 1) fa-spinner
            @else fa-lock
            @endif mr-1"></i>
          @php
            $statusText = match($project->status) {
              0 => 'OPEN FOR COLLABORATION',
              1 => 'ACTIVE DEVELOPMENT',
              default => 'COMPLETED',
            };
          @endphp
          {{ $statusText }}
        </span>
        
        @if($project->github)
        <a href="{{ $project->github }}" target="_blank" class="flex items-center px-3 py-1 rounded-full text-sm bg-gray-800 text-white hover:bg-gray-700 transition">
          <i class="fab fa-github mr-1"></i> GitHub
        </a>
        @endif
        
        @if($project->trello)
        <a href="{{ $project->trello }}" target="_blank" class="flex items-center px-3 py-1 rounded-full text-sm bg-blue-600 text-white hover:bg-blue-700 transition">
          <i class="fab fa-trello mr-1"></i> Trello
        </a>
        @endif
      </div>

      <!-- Project Details Card -->
      <div class="bg-white rounded-xl shadow-card overflow-hidden border border-gray-200">
        <div class="p-8 space-y-10">

          <!-- Description Section -->
          <section>
            <h2 class="text-xl font-semibold mb-4 flex items-center text-gray-800">
              <div class="w-8 h-8 rounded-full bg-primary-50 flex items-center justify-center mr-3 text-primary-600">
                <i class="fas fa-align-left"></i>
              </div>
              Project Description
            </h2>
            <div class="prose max-w-none text-gray-700">
              {!! $project->description ? nl2br(e($project->description)) : '<p class="text-gray-500 italic">No description provided.</p>' !!}
            </div>
          </section>

          <!-- Goals Section -->
          <section>
            <h2 class="text-xl font-semibold mb-4 flex items-center text-gray-800">
              <div class="w-8 h-8 rounded-full bg-accent-50 flex items-center justify-center mr-3 text-accent-600">
                <i class="fas fa-bullseye"></i>
              </div>
              Project Goals
            </h2>
            <div class="prose max-w-none text-gray-700">
              {!! $project->goals ? nl2br(e($project->goals)) : '<p class="text-gray-500 italic">No goals defined.</p>' !!}
            </div>
          </section>

          <!-- Skills & Documents Grid -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <!-- Skills Required -->
            <div>
              <h3 class="text-lg font-semibold mb-4 flex items-center text-gray-800">
                <div class="w-8 h-8 rounded-full bg-purple-50 flex items-center justify-center mr-3 text-purple-600">
                  <i class="fas fa-tools"></i>
                </div>
                Skills Required
              </h3>
              
              @if($project->skills_required)
              <div class="flex flex-wrap gap-2">
                @foreach (json_decode($project->skills_required) as $skill)
                <span class="skill-tag inline-block px-3 py-1.5 rounded-full text-sm bg-primary-100 text-primary-800 font-medium">
                  {{ App\Models\Skill::where('id',$skill)->value('skill') }}
                </span>
                @endforeach
              </div>
              @else
              <p class="text-gray-500 italic">Not specified</p>
              @endif
            </div>

            <!-- Requirements Documents -->
            <div>
              <h3 class="text-lg font-semibold mb-4 flex items-center text-gray-800">
                <div class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center mr-3 text-blue-600">
                  <i class="fas fa-file-alt"></i>
                </div>
                Requirements Documents
              </h3>
              
              @if($project->requirement_documents)
              <div class="flex flex-wrap gap-3">
                @foreach(json_decode($project->requirement_documents,true) as $ind=>$docs)
                <a href="{{ asset('storage/' . $docs) }}" target="_blank"
                  class="document-btn inline-flex items-center px-4 py-2 border border-gray-200 rounded-lg shadow-sm text-sm text-gray-700 bg-white hover:bg-gray-50 transition">
                  <i class="fas fa-file-pdf text-red-500 mr-2"></i>
                  <span>{{$ind}}</span>
                  <i class="fas fa-external-link-alt ml-2 text-gray-400"></i>
                </a>
                @endforeach
              </div>
              @else
              <p class="text-gray-500 italic">No documents uploaded</p>
              @endif
            </div>
          </div>

          <!-- Owner Actions -->
          @if($project->owner_id === Auth::user()->id)
          <div class="flex flex-wrap gap-4 pt-4 border-t border-gray-200">

            <!-- Project Requests Button -->
            <div x-data="{ showRequestsModal: false }">
              <button @click="showRequestsModal = true"
                class="flex items-center px-5 py-2.5 bg-primary-600 text-white rounded-lg shadow hover:bg-primary-700 transition">
                <i class="fas fa-users mr-2"></i> Project Requests
              </button>

              <!-- Requests Modal -->
              <div x-show="showRequestsModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 animate-fade-in"
                x-transition>
                <div @click.away="showRequestsModal = false" class="bg-white rounded-xl shadow-xl p-6 w-full max-w-xl max-h-[80vh] overflow-y-auto animate-slide-up"
                  x-transition>
                  <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-semibold text-gray-800">Project Request Profiles</h2>
                    <button @click="showRequestsModal = false" class="text-gray-500 hover:text-gray-700 text-xl">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>

                  @forelse($projectRequests as $request)
                  <div class="border-b border-gray-100 py-4 last:border-0">
                    <div class="flex items-center gap-4 mb-2">
                      <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-600">
                        <i class="fas fa-user"></i>
                      </div>
                      <div>
                        <p class="font-medium text-gray-800">{{ $request->user->name }}</p>
                        <p class="text-sm text-gray-500">{{ $request->user->email }}</p>
                      </div>
                    </div>
                    <div class="flex justify-between items-center text-sm text-gray-500 mb-2">
                      <span>Requested {{ $request->created_at->diffForHumans() }}</span>
                      <span class="px-2 py-1 rounded-full text-xs font-medium 
                        {{ $request->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                           ($request->status === 'accepted' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800') }}">
                        {{ ucfirst($request->status) }}
                      </span>
                    </div>
                    <a href="/profile/{{ $request->user->id}}"
                      class="inline-block mt-2 px-4 py-1.5 text-sm bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition">
                      View Profile
                    </a>
                  </div>
                  @empty
                  <div class="text-center py-8">
                    <div class="w-16 h-16 mx-auto bg-gray-100 rounded-full flex items-center justify-center text-gray-400 mb-4">
                      <i class="fas fa-users text-xl"></i>
                    </div>
                    <p class="text-gray-500">No project requests found.</p>
                  </div>
                  @endforelse
                </div>
              </div>
            </div>

            <!-- Invite Requests Button -->
            <div x-data="{ showInviteRequests: false }">
              <button @click="showInviteRequests = true"
                class="flex items-center px-5 py-2.5 bg-accent-500 text-white rounded-lg shadow hover:bg-accent-700 transition">
                <i class="fas fa-envelope mr-2"></i> Invite Requests
              </button>

              <!-- Invite Requests Modal -->
              <div x-show="showInviteRequests" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 animate-fade-in"
                x-transition>
                <div @click.away="showInviteRequests = false" class="bg-white rounded-xl shadow-xl p-6 w-full max-w-lg max-h-[80vh] overflow-y-auto animate-slide-up"
                  x-transition>
                  <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-semibold text-gray-800">Project Invitations</h2>
                    <button @click="showInviteRequests = false" class="text-gray-500 hover:text-gray-700 text-xl">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>

                  @forelse($inviteRequests as $invite)
                  <div class="border-b border-gray-100 py-4 last:border-0">
                    <div class="flex items-center gap-3 mb-3">
                      <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center text-purple-600">
                        <i class="fas fa-project-diagram"></i>
                      </div>
                      <div>
                        <p class="font-medium text-gray-800">{{ $invite->project->title }}</p>
                        <p class="text-sm text-gray-500">Invited by {{ $invite->owner->name }}</p>
                      </div>
                    </div>
                    <div class="text-sm text-gray-500 mb-3">
                      Sent {{ $invite->created_at->diffForHumans() }}
                    </div>
                    <a href="/profile/{{$invite->owner->id}}"
                      class="inline-block px-4 py-1.5 text-sm bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition">
                      View Profile
                    </a>
                  </div>
                  @empty
                  <div class="text-center py-8">
                    <div class="w-16 h-16 mx-auto bg-gray-100 rounded-full flex items-center justify-center text-gray-400 mb-4">
                      <i class="fas fa-envelope-open-text text-xl"></i>
                    </div>
                    <p class="text-gray-500">No invite requests found.</p>
                  </div>
                  @endforelse
                </div>
              </div>
            </div>
          </div>
          @endif
        </div>

        <!-- Project Footer -->
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
          <div class="flex items-center gap-3">
            <button class="flex items-center px-4 py-2 text-sm bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-50 text-gray-700 transition">
              <i class="fas fa-share-alt mr-2"></i> Share Project
            </button>

            @if($project->owner_id !== Auth::user()->id)
            <!-- Request to Join Button -->
            <div x-data="{ showRequestModal: false }">
              <button @click="showRequestModal = true" type="button" 
                class="flex items-center px-4 py-2 text-sm text-white bg-primary-600 rounded-lg shadow hover:bg-primary-700 transition">
                <i class="fas fa-user-plus mr-2"></i> Request to Join
              </button>

              <!-- Request Modal -->
              <div x-show="showRequestModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 animate-fade-in"
                x-transition>
                <div @click.away="showRequestModal = false" class="bg-white rounded-xl shadow-xl p-6 w-full max-w-md animate-slide-up"
                  x-transition>
                  <h2 class="text-xl font-semibold mb-6 text-gray-800">Request to Join Project</h2>
                  <form method="POST" action="{{ route('project.request.join', ['id' => $project->id]) }}">
                    @csrf

                    <div class="space-y-4">
                      <!-- To Field -->
                      <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">To</label>
                        <div class="flex items-center gap-3 bg-gray-50 p-3 rounded-lg">
                          <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-600">
                            <i class="fas fa-user"></i>
                          </div>
                          <div>
                            <p class="font-medium text-gray-800">{{ $project->owner->name }}</p>
                            <p class="text-sm text-gray-500">{{ $project->owner->email }}</p>
                          </div>
                        </div>
                      </div>

                      <!-- From Field -->
                      <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">From</label>
                        <div class="flex items-center gap-3 bg-gray-50 p-3 rounded-lg">
                          <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center text-primary-600">
                            <i class="fas fa-user"></i>
                          </div>
                          <div>
                            <p class="font-medium text-gray-800">{{ Auth::user()->name }}</p>
                            <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                          </div>
                        </div>
                      </div>

                      <!-- Message Field -->
                      <div>
                        <label for="body" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                        <textarea id="body" name="body" rows="4" required
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                          placeholder="Tell the project owner why you'd like to join..."></textarea>
                      </div>
                    </div>

                    <div class="flex justify-end gap-3 mt-6">
                      <button type="button" @click="showRequestModal = false" 
                        class="px-4 py-2 text-sm bg-gray-200 rounded-lg hover:bg-gray-300 transition">
                        Cancel
                      </button>
                      <button type="submit" 
                        class="px-4 py-2 text-sm text-black bg-primary-600 rounded-lg hover:bg-primary-700 transition">
                        Send Request
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            @else
            <!-- Invite Members Button -->
            <div x-data="{ showInviteModal: false }">
              <button @click="showInviteModal = true"
                class="flex items-center px-4 py-2 text-sm text-white bg-accent-500 rounded-lg shadow hover:bg-accent-700 transition">
                <i class="fas fa-paper-plane mr-2"></i> Invite Members
              </button>

              <!-- Invite Modal -->
              <div x-show="showInviteModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 animate-fade-in"
                x-transition>
                <div @click.away="showInviteModal = false" class="bg-white rounded-xl shadow-xl p-6 w-full max-w-md animate-slide-up"
                  x-transition>
                  <h2 class="text-xl font-semibold mb-6 text-gray-800">Invite Members</h2>
                  <form method="POST" action="{{ route('sendInvite', $project->id) }}" onsubmit="return validateEmails()">
                    @csrf
                    
                    <div class="space-y-4">
                      <div>
                        <label for="emails" class="block text-sm font-medium text-gray-700 mb-1">Email Addresses</label>
                        <input type="text" name="emails" id="emails" required
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500"
                          placeholder="e.g. user1@example.com, user2@example.com">
                        <p class="mt-1 text-xs text-gray-500">Separate multiple emails with commas</p>
                      </div>

                      <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Invitation Message</label>
                        <textarea id="message" name="message" rows="3"
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500"
                          placeholder="Optional message to include with the invitation"></textarea>
                      </div>
                    </div>

                    <div class="flex justify-end gap-3 mt-6">
                      <button type="button" @click="showInviteModal = false"
                        class="px-4 py-2 text-sm bg-gray-200 rounded-lg hover:bg-gray-300 transition">
                        Cancel
                      </button>
                      <button type="submit"
                        class="px-4 py-2 text-sm text-white bg-accent-500 rounded-lg hover:bg-accent-700 transition">
                        Send Invites
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            @endif
          </div>

          <!-- Delete Project Button (Owner Only) -->
          @if($project->owner_id === Auth::user()->id)
          <div x-data="{ showDeleteModal: false }">
            <button @click="showDeleteModal = true"
              class="flex items-center px-4 py-2 text-sm text-white bg-danger-600 rounded-lg shadow hover:bg-danger-700 transition">
              <i class="fas fa-trash-alt mr-2"></i> Delete Project
            </button>

            <!-- Delete Confirmation Modal -->
            <div x-show="showDeleteModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 animate-fade-in"
              x-transition>
              <div @click.away="showDeleteModal = false" class="bg-white rounded-xl shadow-xl p-6 w-full max-w-md animate-slide-up"
                x-transition>
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Confirm Project Deletion</h2>
                <p class="mb-4 text-gray-600">
                  This will permanently delete the project and all associated data. This action cannot be undone.
                </p>

                <form method="POST" action="{{ route('deleteProject') }}" id="deleteForm">
                  @csrf
                  @method('DELETE')
                  
                  <div class="space-y-4">
                    <div>
                      <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Your Password</label>
                      <input type="password" name="password" id="password" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-danger-500 focus:border-danger-500"
                        placeholder="Enter your password to confirm">
                    </div>
                    
                    <input type="hidden" name="id" value="{{ $project->id }}">
                  </div>

                  <div class="flex justify-end gap-3 mt-6">
                    <button type="button" @click="showDeleteModal = false"
                      class="px-4 py-2 text-sm bg-gray-200 rounded-lg hover:bg-gray-300 transition">
                      Cancel
                    </button>
                    <button type="submit"
                      class="px-4 py-2 text-sm text-white bg-danger-600 rounded-lg hover:bg-danger-700 transition">
                      Confirm Delete
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          @endif
        </div>
      </div>
    </div>

    <!-- Team Section -->
    @include('team')
  </main>

  <script>
    // Email validation for invite form
    function validateEmails() {
      const input = document.getElementById('emails').value;
      const emailArray = input.split(',').map(email => email.trim());
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

      for (let email of emailArray) {
        if (!emailRegex.test(email)) {
          alert(`Invalid email: ${email}`);
          return false; // stop form submission
        }
      }

      return true;
    }

    // Delete form handling
    document.getElementById('deleteForm')?.addEventListener('submit', function(e) {
      e.preventDefault();
      
      const password = document.getElementById('password').value.trim();
      if (!password) {
        alert('Please enter your password to confirm deletion');
        return;
      }

      if (confirm('Are you absolutely sure you want to delete this project? This cannot be undone.')) {
        this.submit();
      }
    });
  </script>
</body>
</html>