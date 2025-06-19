<aside class="bg-gradient-to-b from-indigo-50 to-white border-r border-indigo-100 flex flex-col justify-between" style="width: 25%;">
  <div>
    <!-- Logo Section -->
    <div class="h-20 flex items-center px-6">
      <div class="w-20 h-20 rounded overflow-hidden mr-3">
        <img
          src="assets/collab.png"
          alt="CollabNest Logo"
          class="w-full h-full object-contain" />
      </div>
      <a class="text-indigo-700 font-bold text-xl tracking-tight" href="#">
        <span class="bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">CollabNest</span>
      </a>
    </div>
    
    <!-- User Profile Section -->
    <div class="px-6 mb-6">
      <a href="/profile/{{Auth::user()->id}}">
        <div class="flex items-center space-x-4 bg-white rounded-xl p-3 shadow-sm border border-indigo-50 hover:border-indigo-100 transition-all">
          @php
          $profile = App\Models\UserProfile::where('user_id',Auth::user()->id)->first();
          $userProfile = json_decode($profile->profile_settings,true);
          $image = $userProfile['image'] ?? [];
          @endphp
          <div class="relative">
            <img alt="Profile" class="rounded-full w-12 h-12 object-cover border-2 border-white shadow" src="{{ $image ? asset('storage/'. $image) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&color=FFFFFF&background=6366f1'}}" />
            <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-400 rounded-full border-2 border-white"></div>
          </div>
          <div>
            <p class="font-bold text-gray-900 text-sm leading-tight">{{ isset($userProfile['first_name']) ? $userProfile['first_name'].' '.$userProfile['last_name'] : Auth::user()->name}}</p>
            <p class="text-indigo-500 text-xs leading-tight">{{ Auth::user()->email }}</p>
          </div>
        </div>
      </a>
    </div>
    
    <!-- Navigation Menu -->
    <nav class="flex flex-col space-y-1 px-4 text-sm font-medium">
      <!-- Dashboard -->
      <a href="{{ route('dashboard') }}"
        class="flex items-center space-x-3 py-2.5 px-4 rounded-xl 
            {{ request()->routeIs('dashboard') ? 'bg-indigo-600 text-white shadow-md' : 'hover:bg-indigo-50 text-gray-700 hover:text-indigo-700' }}">
        <i class="fas fa-home w-5 text-center {{ request()->routeIs('dashboard') ? 'text-white' : 'text-indigo-500' }}"></i>
        <span>Dashboard</span>
      </a>

      @php
      $profileurl = 'profile/' . Auth::user()->id;
      @endphp

      <!-- Profile Section -->
      <div>
        <div id="profileShow"
          class="flex items-center space-x-3 py-2.5 px-4 rounded-xl cursor-pointer
          {{ request()->is($profileurl) || request()->routeIs('projectInvites') ? 'bg-indigo-50 text-indigo-700' : 'hover:bg-indigo-50 text-gray-700 hover:text-indigo-700' }}">
          <i class="fas fa-user-tie w-5 text-center text-indigo-500"></i>
          <span>Profile</span>
          <i class="fas fa-chevron-down ml-auto text-xs text-indigo-400 transition-transform duration-200 {{ request()->is($profileurl) || request()->routeIs('projectInvites') ? 'transform rotate-180' : '' }}"></i>
        </div>

        <div class="profile_branch pl-4 ml-5 border-l-2 border-indigo-100 {{request()->is($profileurl) || request()->routeIs('projectInvites')  ? 'block' : 'hidden'}}">
          <a href="/profile/{{Auth::user()->id}}"
            class="flex items-center space-x-3 py-2 px-4 rounded-lg 
            {{ request()->is($profileurl) ? 'bg-indigo-100 text-indigo-700 font-semibold' : 'hover:bg-indigo-50 text-gray-600 hover:text-indigo-700' }}">
            <i class="fas fa-circle text-xs text-indigo-400"></i>
            <span>My Profile</span>
          </a>

          <a href="{{route('projectInvites')}}"
            class="flex items-center space-x-3 py-2 px-4 rounded-lg 
            {{ request()->routeIs('projectInvites') ? 'bg-indigo-100 text-indigo-700 font-semibold' : 'hover:bg-indigo-50 text-gray-600 hover:text-indigo-700' }}">
            <i class="fas fa-circle text-xs text-indigo-400"></i>
            <span>Invites</span>
          </a>
        </div>
      </div>

      <!-- Users -->
      <a href="{{ route('navUsers') }}"
        class="flex items-center space-x-3 py-2.5 px-4 rounded-xl 
            {{ request()->routeIs('navUsers') ? 'bg-indigo-600 text-white shadow-md' : 'hover:bg-indigo-50 text-gray-700 hover:text-indigo-700' }}">
        <i class="fas fa-users w-5 text-center {{ request()->routeIs('navUsers') ? 'text-white' : 'text-indigo-500' }}"></i>
        <span>Users</span>
      </a>

      <!-- Projects Section -->
      <div>
        <div id="project"
          class="flex items-center space-x-3 py-2.5 px-4 rounded-xl cursor-pointer
          {{ request()->routeIs('projects') || request()->routeIs('navMyProject') || request()->routeIs('viewProject') || request()->routeIs('editProject') || request()->routeIs('navCreateProject') ? 'bg-indigo-50 text-indigo-700' : 'hover:bg-indigo-50 text-gray-700 hover:text-indigo-700' }}">
          <i class="fas fa-box w-5 text-center text-indigo-500"></i>
          <span>Projects</span>
          <i class="fas fa-chevron-down ml-auto text-xs text-indigo-400 transition-transform duration-200 {{ request()->routeIs('projects') || request()->routeIs('navMyProject') || request()->routeIs('viewProject') || request()->routeIs('editProject') || request()->routeIs('navCreateProject') ? 'transform rotate-180' : '' }}"></i>
        </div>

        <div class="branch pl-4 ml-5 border-l-2 border-indigo-100 {{ request()->routeIs('projects') || request()->routeIs('navMyProject') || request()->routeIs('viewProject') || request()->routeIs('editProject') || request()->routeIs('navCreateProject') ?'block' :'hidden'}}">
          <a href="{{route('projects')}}"
            class="flex items-center space-x-3 py-2 px-4 rounded-lg 
              {{ request()->routeIs('projects') ? 'bg-indigo-100 text-indigo-700 font-semibold' : 'hover:bg-indigo-50 text-gray-600 hover:text-indigo-700' }}">
            <i class="fas fa-circle text-xs text-indigo-400"></i>
            <span>All Projects</span>
          </a>

          <a href="{{ route('navMyProject') }}"
            class="flex items-center space-x-3 py-2 px-4 rounded-lg 
            {{ request()->routeIs('navMyProject')  ? 'bg-indigo-100 text-indigo-700 font-semibold' : 'hover:bg-indigo-50 text-gray-600 hover:text-indigo-700' }}">
            <i class="fas fa-circle text-xs text-indigo-400"></i>
            <span>My Projects</span>
          </a>
        </div>
      </div>

      <!-- Messages -->
      <a href="{{ route('messages') }}"
        class="flex items-center space-x-3 py-2.5 px-4 rounded-xl 
            {{ request()->routeIs('messages') ? 'bg-indigo-600 text-white shadow-md' : 'hover:bg-indigo-50 text-gray-700 hover:text-indigo-700' }}">
        <i class="far fa-comment w-5 text-center {{ request()->routeIs('messages') ? 'text-white' : 'text-indigo-500' }}"></i>
        <span>Messages</span>
      </a>

      <!-- Meetings -->
      <a href="{{ route('meetings') }}"
        class="flex items-center space-x-3 py-2.5 px-4 rounded-xl 
            {{ request()->routeIs('meetings') ? 'bg-indigo-600 text-white shadow-md' : 'hover:bg-indigo-50 text-gray-700 hover:text-indigo-700' }}">
        <i class="fas fa-video w-5 text-center {{ request()->routeIs('meetings') ? 'text-white' : 'text-indigo-500' }}"></i>
        <span>Meetings</span>
      </a>

      <!-- Settings Section -->
      <div>
        <div id="settings"
          class="flex items-center space-x-3 py-2.5 px-4 rounded-xl cursor-pointer
          {{ request()->routeIs('changepass') || request()->routeIs('help') ? 'bg-indigo-50 text-indigo-700' : 'hover:bg-indigo-50 text-gray-700 hover:text-indigo-700' }}">
          <i class="fas fa-cog w-5 text-center text-indigo-500"></i>
          <span>Settings</span>
          <i class="fas fa-chevron-down ml-auto text-xs text-indigo-400 transition-transform duration-200 {{ request()->routeIs('changepass') || request()->routeIs('help') ? 'transform rotate-180' : '' }}"></i>
        </div>

        <div class="setting_branch pl-4 ml-5 border-l-2 border-indigo-100 {{ request()->routeIs('changepass') || request()->routeIs('help') ? 'block' : 'hidden'}}">
          <a href="{{route('changepass')}}"
            class="flex items-center space-x-3 py-2 px-4 rounded-lg 
            {{ request()->routeIs('changepass') ? 'bg-indigo-100 text-indigo-700 font-semibold' : 'hover:bg-indigo-50 text-gray-600 hover:text-indigo-700' }}">
            <i class="fas fa-circle text-xs text-indigo-400"></i>
            <span>Change Password</span>
          </a>

          <a href="{{route('help')}}"
            class="flex items-center space-x-3 py-2 px-4 rounded-lg 
              {{ request()->routeIs('help') ? 'bg-indigo-100 text-indigo-700 font-semibold' : 'hover:bg-indigo-50 text-gray-600 hover:text-indigo-700' }}">
            <i class="fas fa-circle text-xs text-indigo-400"></i>
            <span>Help</span>
          </a>
        </div>
      </div>
    </nav>
  </div>

  <!-- Logout Section -->
  <div class="px-6 py-4 border-t border-indigo-100">
    <form method="POST" action="/logout">
      @csrf
      <button type="submit" class="w-full bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-semibold py-2.5 px-4 rounded-xl flex items-center justify-center space-x-2 transition-all duration-200 shadow hover:shadow-md">
        <i class="fas fa-sign-out-alt"></i>
        <span>Logout</span>
      </button>
    </form>
  </div>
</aside>

<script>
  // Toggle Profile Section
  let profileShow = document.querySelector('#profileShow');
  let profileBranch = document.querySelector('.profile_branch');
  let profileChevron = profileShow.querySelector('.fa-chevron-down');

  profileShow.addEventListener('click', () => {
    let isHidden = profileBranch.style.display === 'none' || !profileBranch.style.display;
    profileBranch.style.display = isHidden ? 'block' : 'none';
    profileChevron.style.transform = isHidden ? 'rotate(180deg)' : 'rotate(0deg)';
  });

  // Toggle Projects Section
  let project = document.querySelector('#project');
  let branches = document.querySelector('.branch');
  let projectChevron = project.querySelector('.fa-chevron-down');

  project.addEventListener('click', () => {
    let isHidden = branches.style.display === 'none' || !branches.style.display;
    branches.style.display = isHidden ? 'block' : 'none';
    projectChevron.style.transform = isHidden ? 'rotate(180deg)' : 'rotate(0deg)';
  });

  // Toggle Settings Section
  let settings = document.querySelector('#settings');
  let settingBranch = document.querySelector('.setting_branch');
  let settingsChevron = settings.querySelector('.fa-chevron-down');

  settings.addEventListener('click', () => {
    let isHidden = settingBranch.style.display === 'none' || !settingBranch.style.display;
    settingBranch.style.display = isHidden ? 'block' : 'none';
    settingsChevron.style.transform = isHidden ? 'rotate(180deg)' : 'rotate(0deg)';
  });
</script>