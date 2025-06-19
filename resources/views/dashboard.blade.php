<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>Dashboard | TeamCollab</title>
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
            warning: {
              50: '#fefce8',
              100: '#fef9c3',
              500: '#eab308',
            }
          }
        }
      }
    }
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
  <script src="https://unpkg.com/alpinejs" defer></script>
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    }
    .stat-card:hover {
      transform: translateY(-3px);
    }
    .progress-ring__circle {
      transition: stroke-dashoffset 0.5s ease;
      transform: rotate(-90deg);
      transform-origin: 50% 50%;
    }
  </style>
</head>

<body class="min-h-screen flex">
    
  <!-- Sidebar -->
  @include("layout.aside")
  
  <!-- Main content -->
  <main class="flex-1 p-6 md:p-8 overflow-y-auto">
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
          <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Welcome back, {{Auth::user()->name}}!</h1>
          <p class="text-gray-500 mt-1">Here's what's happening with your projects</p>
        </div>
        <div class="flex items-center gap-3">
          <span class="text-sm text-gray-500 hidden md:block">Last updated: {{ now()->format('M j, Y g:i A') }}</span>
          <button class="text-primary-500 hover:text-primary-600">
            <i class="fas fa-sync-alt"></i>
          </button>
        </div>
      </div>

      <!-- Stats Grid -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Active Projects -->
        <div class="stat-card bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-all duration-300 border-l-4 border-primary-500">
          <div class="flex justify-between items-start">
            <div>
              <p class="text-gray-500 text-sm font-medium">Active Projects</p>
              <p class="text-3xl font-bold mt-1">5</p>
            </div>
            <div class="w-12 h-12 bg-primary-50 rounded-lg flex items-center justify-center text-primary-500">
              <i class="fas fa-folder-open text-xl"></i>
            </div>
          </div>
          <div class="mt-4 flex items-center text-sm text-gray-500">
            <i class="fas fa-arrow-up text-emerald-500 mr-1"></i>
            <span>2 new this week</span>
          </div>
        </div>

        <!-- Tasks Assigned -->
        <div class="stat-card bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-all duration-300 border-l-4 border-accent-500">
          <div class="flex justify-between items-start">
            <div>
              <p class="text-gray-500 text-sm font-medium">Your Tasks</p>
              <p class="text-3xl font-bold mt-1">12</p>
            </div>
            <div class="w-12 h-12 bg-accent-50 rounded-lg flex items-center justify-center text-accent-500">
              <i class="fas fa-tasks text-xl"></i>
            </div>
          </div>
          <div class="mt-4">
            <div class="flex justify-between text-xs text-gray-500 mb-1">
              <span>Completed</span>
              <span>8/12</span>
            </div>
            <div class="w-full bg-gray-100 rounded-full h-2">
              <div class="bg-accent-500 h-2 rounded-full" style="width: 67%"></div>
            </div>
          </div>
        </div>

        <!-- Team Members -->
        <div class="stat-card bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-all duration-300 border-l-4 border-secondary-500">
          <div class="flex justify-between items-start">
            <div>
              <p class="text-gray-500 text-sm font-medium">Team Members</p>
              <p class="text-3xl font-bold mt-1">8</p>
            </div>
            <div class="w-12 h-12 bg-secondary-50 rounded-lg flex items-center justify-center text-secondary-500">
              <i class="fas fa-users text-xl"></i>
            </div>
          </div>
          <div class="mt-4 flex items-center text-sm text-gray-500">
            <span class="inline-flex -space-x-2">
              <img class="w-6 h-6 rounded-full border-2 border-white" src="https://randomuser.me/api/portraits/women/12.jpg" alt="">
              <img class="w-6 h-6 rounded-full border-2 border-white" src="https://randomuser.me/api/portraits/men/32.jpg" alt="">
              <img class="w-6 h-6 rounded-full border-2 border-white" src="https://randomuser.me/api/portraits/women/44.jpg" alt="">
              <span class="w-6 h-6 rounded-full border-2 border-white bg-gray-100 flex items-center justify-center text-xs font-medium">+5</span>
            </span>
          </div>
        </div>

        <!-- Upcoming Deadlines -->
        <div class="stat-card bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-all duration-300 border-l-4 border-warning-500">
          <div class="flex justify-between items-start">
            <div>
              <p class="text-gray-500 text-sm font-medium">Upcoming Deadlines</p>
              <p class="text-3xl font-bold mt-1">3</p>
            </div>
            <div class="w-12 h-12 bg-warning-50 rounded-lg flex items-center justify-center text-warning-500">
              <i class="fas fa-calendar-alt text-xl"></i>
            </div>
          </div>
          <div class="mt-4 text-sm text-gray-500">
            <div class="flex items-center">
              <span class="w-2 h-2 bg-red-500 rounded-full mr-2"></span>
              <span>1 critical</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Recent Activity & Quick Actions -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Recent Activity -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm p-6">
          <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-semibold text-gray-800">Recent Activity</h2>
            <a href="#" class="text-primary-500 text-sm hover:underline">View All</a>
          </div>
          <div class="space-y-4">
            <!-- Activity Item -->
            <div class="flex items-start gap-3">
              <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 mt-1 flex-shrink-0">
                <i class="fas fa-comment"></i>
              </div>
              <div>
                <p class="text-sm text-gray-800"><span class="font-medium">Sarah Johnson</span> commented on <span class="font-medium">Project Alpha</span></p>
                <p class="text-xs text-gray-500 mt-1">"Let's discuss the UI changes in our next meeting"</p>
                <p class="text-xs text-gray-400 mt-1">2 hours ago</p>
              </div>
            </div>
            <!-- Activity Item -->
            <div class="flex items-start gap-3">
              <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 mt-1 flex-shrink-0">
                <i class="fas fa-check-circle"></i>
              </div>
              <div>
                <p class="text-sm text-gray-800"><span class="font-medium">You</span> completed task <span class="font-medium">Dashboard Design</span></p>
                <p class="text-xs text-gray-400 mt-1">Yesterday at 4:32 PM</p>
              </div>
            </div>
            <!-- Activity Item -->
            <div class="flex items-start gap-3">
              <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-600 mt-1 flex-shrink-0">
                <i class="fas fa-user-plus"></i>
              </div>
              <div>
                <p class="text-sm text-gray-800"><span class="font-medium">Michael Chen</span> joined <span class="font-medium">Project Beta</span></p>
                <p class="text-xs text-gray-400 mt-1">Yesterday at 10:15 AM</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-sm p-6">
          <h2 class="text-lg font-semibold text-gray-800 mb-6">Quick Actions</h2>
          <div class="grid grid-cols-2 gap-4">
            <a href="/navcreateproject" class="flex flex-col items-center justify-center p-4 rounded-lg bg-primary-50 text-primary-600 hover:bg-primary-100 transition-colors">
              <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center mb-2">
                <i class="fas fa-plus"></i>
              </div>
              <span class="text-sm font-medium text-center">New Project</span>
            </a>
            <a href="#" class="flex flex-col items-center justify-center p-4 rounded-lg bg-accent-50 text-accent-600 hover:bg-accent-100 transition-colors">
              <div class="w-10 h-10 rounded-full bg-accent-100 flex items-center justify-center mb-2">
                <i class="fas fa-tasks"></i>
              </div>
              <span class="text-sm font-medium text-center">Add Task</span>
            </a>
            <a href="{{ route('navUsers') }}" class="flex flex-col items-center justify-center p-4 rounded-lg bg-secondary-50 text-secondary-600 hover:bg-secondary-100 transition-colors">
              <div class="w-10 h-10 rounded-full bg-secondary-100 flex items-center justify-center mb-2">
                <i class="fas fa-user-plus"></i>
              </div>
              <span class="text-sm font-medium text-center">Invite Member</span>
            </a>

          </div>
        </div>
      </div>

      <!-- Projects Progress -->
      <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
        <div class="flex justify-between items-center mb-6">
          <h2 class="text-lg font-semibold text-gray-800">Projects Progress</h2>
          <a href="{{ route('navMyProject') }}" class="text-primary-500 text-sm hover:underline">View All Projects</a>
        </div>
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Project</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Due Date</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Progress</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="flex-shrink-0 h-10 w-10">
                      <img class="h-10 w-10 rounded-full" src="https://via.placeholder.com/40" alt="">
                    </div>
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">Project Alpha</div>
                      <div class="text-sm text-gray-500">Web Development</div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">Jun 30, 2023</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="w-full bg-gray-200 rounded-full h-2.5">
                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: 72%"></div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">On Track</span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </main>
</body>
</html>