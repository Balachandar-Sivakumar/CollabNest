<aside class="w-72 bg-white border-r border-gray-200 flex flex-col justify-between min-w-72">
    <div>
      <div class="px-5 pt-5 pb-5" style="display:flex; align-items:center; gap:8px">
        <div class="w-30 h-30 rounded overflow-hidden">
        <img
          src="assets/logo.png"
          alt="CollabNest Logo"
          class="w-full h-full object-contain"
        />
      </div>
        <a class="text-indigo-700 font-semibold text-lg" href="#">CollabNest</a>
      </div>
      <div class="px-6 mb-6">
        <div class="flex items-center space-x-4 bg-gray-100 rounded-lg py-3 px-4">
          <img alt="Profile" class="rounded-full w-10 h-10 object-cover" src="https://cdn-icons-png.freepik.com/256/12483/12483554.png?uid=R156815013&ga=GA1.1.1574424695.1745626358&semt=ais_incoming" />
          <div>
           
            <p class="font-semibold text-gray-900 text-sm leading-tight">{{ Auth::user()->name }}</p>
            <p class="text-gray-500 text-xs leading-tight">{{ Auth::user()->email }}</p>
          </div>
        </div>
      </div>
    <nav class="flex flex-col space-y-2 px-6 text-sm font-semibold">
  <a href="{{ route('dashboard') }}"
     class="flex items-center space-x-2 py-2 px-3 rounded-md 
            {{ request()->routeIs('dashboard') ? 'bg-indigo-100 text-indigo-700' : 'hover:bg-gray-100 text-gray-900' }}">
    <i class="fas fa-home"></i><span>Dashboard</span>
  </a>

  <a href="{{ route('team') }}"
     class="flex items-center space-x-2 py-2 px-3 rounded-md 
            {{ request()->routeIs('team') ? 'bg-indigo-100 text-indigo-700' : 'hover:bg-gray-100 text-gray-900' }}">
    <i class="fas fa-users"></i><span>Team</span>
  </a>

  <a href="{{ route('projects') }}"
     class="flex items-center space-x-2 py-2 px-3 rounded-md 
            {{ request()->routeIs('projects') ? 'bg-indigo-100 text-indigo-700' : 'hover:bg-gray-100 text-gray-900' }}">
    <i class="fas fa-box"></i><span>Projects</span>
  </a>

  <a href="{{ route('tasks') }}"
     class="flex items-center space-x-2 py-2 px-3 rounded-md 
            {{ request()->routeIs('tasks') ? 'bg-indigo-100 text-indigo-700' : 'hover:bg-gray-100 text-gray-900' }}">
    <i class="fas fa-check-square"></i><span>Tasks</span>
  </a>

  <a href="{{ route('messages') }}"
     class="flex items-center space-x-2 py-2 px-3 rounded-md 
            {{ request()->routeIs('messages') ? 'bg-indigo-100 text-indigo-700' : 'hover:bg-gray-100 text-gray-900' }}">
    <i class="far fa-comment"></i><span>Messages</span>
  </a>

  <a href="{{ route('meetings') }}"
     class="flex items-center space-x-2 py-2 px-3 rounded-md 
            {{ request()->routeIs('meetings') ? 'bg-indigo-100 text-indigo-700' : 'hover:bg-gray-100 text-gray-900' }}">
    <i class="fas fa-video"></i><span>Meetings</span>
  </a>

  <a href="{{ route('files') }}"
     class="flex items-center space-x-2 py-2 px-3 rounded-md 
            {{ request()->routeIs('files') ? 'bg-indigo-100 text-indigo-700' : 'hover:bg-gray-100 text-gray-900' }}">
    <i class="far fa-file-alt"></i><span>Files</span>
  </a>

  <a href="{{ route('settings') }}"
     class="flex items-center space-x-2 py-2 px-3 rounded-md 
            {{ request()->routeIs('settings') ? 'bg-indigo-100 text-indigo-700' : 'hover:bg-gray-100 text-gray-900' }}">
    <i class="fas fa-cog"></i><span>Settings</span>
  </a>
</nav>


    </div>

    <div class="px-6 py-4 border-t border-gray-200">
      <form method="POST" action="/logout">
        @csrf
        <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white text-sm font-semibold py-2 px-4 rounded-lg flex items-center justify-center space-x-2 transition-all duration-200">
          <i class="fas fa-sign-out-alt"></i>
          <span>Logout</span>
        </button>
      </form>
    </div>
  </aside>
