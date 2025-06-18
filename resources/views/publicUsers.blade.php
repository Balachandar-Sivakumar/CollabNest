<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>TeamCollab Dashboard - Public Users</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet"/>
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>
<body class="bg-[#f8fafc] text-gray-900 min-h-screen flex">

  <!-- Sidebar - Preserved as original -->
  @include('layout.aside')

  <!-- Main Content Area -->
  <main class="flex-1 p-8 overflow-auto">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold text-gray-800">All Users</h1>
      
      <div class="flex space-x-4">
        <!-- Search Input -->
        <div class="relative">
          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <i class="fas fa-search text-gray-400"></i>
          </div>
          <input 
            id="searchInput"
            type="text" 
            class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
            placeholder="Search by skill (e.g. Laravel)">
        </div>
        
        <!-- Sort Dropdown -->
        <div class="relative">
          <select 
            id="sortSelect"
            class="appearance-none pl-3 pr-8 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <option value="name">Sort by Name</option>
            <option value="profession">Sort by Profession</option>
          </select>
          <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
            <i class="fas fa-chevron-down text-gray-400"></i>
          </div>
        </div>
      </div>
    </div>
    
    <div id="usersContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach($users as $user)
        @php 
          $profession_id = \App\Models\UserTag::where('user_id',$user->id)->where('tag_model','profession')->pluck('tag_id');
          $skill_id = \App\Models\UserTag::where('user_id',$user->id)->where('tag_model','tech_skill')->pluck('tag_id');
          $profile = \App\Models\UserProfile::where('user_id',$user->id)->first();
          $userProfile = json_decode($profile,true)['profile_settings'];
          $image = json_decode($userProfile,true)['image'] ?? [];
          $bio = json_decode($userProfile,true)['bio'] ?? '';
          
         
          $skills = [];
          foreach($skill_id as $skill) {
              $skills[] = \App\Models\Skill::where('id',$skill)->value('skill');
          }
          $skillsString = implode(',', $skills);
          
         
          $professions = [];
          foreach($profession_id as $prof) {
              $professions[] = \App\Models\Profession::where('id',$prof)->value('profession');
          }
          $professionString = implode(',', $professions);
        @endphp
      
        <!-- User Card -->
        <div class="userCard bg-white border border-gray-200 rounded-2xl shadow hover:shadow-md transition-all duration-300 p-6"
             data-name="{{ $user->name }}"
             data-profession="{{ $professionString }}"
             data-skills="{{ $skillsString }}">
          <div class="flex items-center space-x-4">
            <img src="{{ $image ? asset('storage/'. $image) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&color=7F9CF5&background=EBF4FF'}}" alt="User photo" class="w-16 h-16 rounded-full object-cover border-2 border-white shadow-sm">
            <div>
              <h3 class="text-lg font-semibold text-gray-800">{{$user->name}}</h3>

              @foreach($profession_id as $id)
              <p class="text-sm text-blue-500">{{\App\Models\Profession::where('id',$id)->value('profession')}}</p>
              @endforeach
              <div class="flex mt-1 space-x-1 flex-wrap">
                @foreach($skill_id as $skill)
                <span class="text-xs px-2 py-1 bg-blue-50 text-blue-600 rounded-full mb-1">{{\App\Models\Skill::where('id',$skill)->value('skill')}}</span>
                @endforeach
              </div>
            </div>
          </div>
          <p class="mt-4 text-gray-600 text-sm">
            {{$bio}}
          </p>
          <a href="/profile/{{$user->id}}" class="inline-block mt-4 px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition">
            View Profile
          </a>
        </div>
      @endforeach
    </div>
  </main>

  <script>
  $(document).ready(function() {
    // Filter users based on search input
    $('#searchInput').on('input', function() {
      const searchTerm = $(this).val().toLowerCase();
      
      $('.userCard').each(function() {
        const skills = $(this).data('skills').toLowerCase();
        const matches = searchTerm === '' || skills.includes(searchTerm);
        $(this).toggle(matches);
      });
    });
    
    // Sort users based on dropdown selection
    $('#sortSelect').change(function() {
      const sortBy = $(this).val();
      const $container = $('#usersContainer');
      const $cards = $('.userCard').detach().toArray();
      
      $cards.sort(function(a, b) {
        const aValue = $(a).data(sortBy).toLowerCase();
        const bValue = $(b).data(sortBy).toLowerCase();
        return aValue.localeCompare(bValue);
      });
      
      $.each($cards, function(i, card) {
        $container.append(card);
      });
    });
  });
  </script>
</body>
</html>