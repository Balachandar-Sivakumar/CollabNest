<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>TeamCollab Dashboard - Public Users</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
  <style>
    body { 
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    }
    .user-card {
      transition: all 0.3s ease;
      background: white;
      border-radius: 16px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.3);
      backdrop-filter: blur(10px);
    }
    .user-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    .skill-tag {
      transition: all 0.2s ease;
    }
    .skill-tag:hover {
      transform: scale(1.05);
    }
    .search-input:focus {
      box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
    }
    .gradient-text {
      background: linear-gradient(90deg, #6366f1, #8b5cf6);
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
    }
  </style>
</head>
<body class="text-gray-800 min-h-screen flex">

  <!-- Sidebar - Preserved as original -->
  @include('layout.aside')

  <!-- Main Content Area -->
  <main class="flex-1 p-8 overflow-auto">
    <div class="max-w-7xl mx-auto">
      <!-- Header Section -->
      <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
        <div class="mb-4 md:mb-0">
          <h1 class="text-3xl font-bold gradient-text">Discover Team Members</h1>
          <p class="text-gray-500 mt-1">Find and connect with talented professionals</p>
        </div>
        
        <!-- Search and Filter -->
        <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto">
          <!-- Search Input -->
          <div class="relative flex-1">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <i class="fas fa-search text-gray-400"></i>
            </div>
            <input 
              id="searchInput"
              type="text" 
              class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 bg-white shadow-sm" 
              placeholder="Search by name, skill or profession">
          </div>
          
          <!-- Sort Dropdown -->
          <div class="relative w-full sm:w-48">
            <select 
              id="sortSelect"
              class="appearance-none w-full pl-3 pr-8 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 bg-white shadow-sm">
              <option value="name">Sort by Name</option>
              <option value="profession">Sort by Profession</option>
              <option value="skills">Sort by Skills</option>
            </select>
            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
              <i class="fas fa-chevron-down text-gray-400"></i>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Users Grid -->
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
          <div class="user-card p-6"
               data-name="{{ $user->name }}"
               data-profession="{{ $professionString }}"
               data-skills="{{ $skillsString }}">
            <div class="flex items-start space-x-4">
              <div class="relative">
                <img 
                  src="{{ $image ? asset('storage/'. $image) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&color=FFFFFF&background=6366f1'}}" 
                  alt="User photo" 
                  class="w-16 h-16 rounded-xl object-cover border-2 border-white shadow-md">
                <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-400 rounded-full border-2 border-white"></div>
              </div>
              <div class="flex-1">
                <h3 class="text-lg font-bold text-gray-800">{{$user->name}}</h3>
                
                <!-- Profession Badge -->
                @foreach($profession_id as $id)
                <span class="inline-block mt-1 px-3 py-1 bg-indigo-100 text-indigo-700 text-xs font-semibold rounded-full">
                  {{\App\Models\Profession::where('id',$id)->value('profession')}}
                </span>
                @endforeach
                
                <!-- Skills Tags -->
                <div class="flex flex-wrap gap-2 mt-3">
                  @foreach($skill_id as $skill)
                  <span class="skill-tag px-2.5 py-1 bg-gradient-to-br from-blue-50 to-indigo-50 text-indigo-600 text-xs font-medium rounded-full border border-indigo-100">
                    {{\App\Models\Skill::where('id',$skill)->value('skill')}}
                  </span>
                  @endforeach
                </div>
              </div>
            </div>
            
            <!-- Bio -->
            <p class="mt-4 text-gray-600 text-sm leading-relaxed">
              {{ strlen($bio) > 120 ? substr($bio, 0, 120).'...' : $bio }}
            </p>
            
            <!-- Action Button -->
            <div class="mt-6">
              <a href="/profile/{{$user->id}}" class="inline-flex items-center justify-center w-full px-4 py-2.5 bg-gradient-to-r from-indigo-500 to-indigo-600 text-white font-medium rounded-lg hover:from-indigo-600 hover:to-indigo-700 transition-all shadow-sm hover:shadow-md">
                <i class="fas fa-user-circle mr-2"></i>
                View Profile
              </a>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </main>

  <script>
  $(document).ready(function() {
    // Filter users based on search input
    $('#searchInput').on('input', function() {
      const searchTerm = $(this).val().toLowerCase();
      
      $('.user-card').each(function() {
        const name = $(this).data('name').toLowerCase();
        const skills = $(this).data('skills').toLowerCase();
        const profession = $(this).data('profession').toLowerCase();
        
        const matches = searchTerm === '' || 
                        name.includes(searchTerm) || 
                        skills.includes(searchTerm) || 
                        profession.includes(searchTerm);
                        
        $(this).toggle(matches);
      });
    });
    
    // Sort users based on dropdown selection
    $('#sortSelect').change(function() {
      const sortBy = $(this).val();
      const $container = $('#usersContainer');
      const $cards = $('.user-card').detach().toArray();
      
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