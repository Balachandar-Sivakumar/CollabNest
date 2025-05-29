<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>TeamCollab Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body class="bg-[#f1f5f9] text-gray-900 min-h-screen flex">

  @include('layout.aside')

  <div class="flex-1 p-6">
    <div class="max-w-6xl mx-auto bg-white shadow-md rounded-3xl overflow-hidden p-8">
      <div class="flex flex-col md:flex-row items-center md:items-start gap-8">
        <!-- Profile Image -->
        <div class="flex-shrink-0">
          @php
            $settings = json_decode($skills->profile_settings, true);
            $imagePath = $settings['image'] ?? null;
          @endphp
          <img class="w-32 h-32 md:w-36 md:h-36 rounded-full object-cover border-4 border-cyan-600 shadow-lg"
               src="{{ $imagePath ? asset('storage/' . $imagePath) : asset('images/default-profile.png') }}" alt="Profile Picture">
        </div>

        <!-- Profile Info -->
        <div class="flex-1 space-y-6">
          <!-- Name & Professions -->
          <div>
            <h2 class="text-3xl font-bold text-gray-900">{{ Auth::user()->name }}</h2>
            <div class="mt-2 flex flex-wrap gap-2">
              
             @foreach(json_decode($skills->profile_settings, true)['profession'] ?? [] as $n)
                <span class="bg-cyan-100 text-cyan-800 text-xs font-semibold px-3 py-1 rounded-full shadow-sm">{{ $n }}</span>
              @endforeach
            </div>
          </div>

          <!-- Key Info Grid -->
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 text-sm">
            <div>
              <p class="text-gray-500">User ID</p>
              <p class="font-medium">{{ Auth::user()->id }}</p>
            </div>
            <div>
              <p class="text-gray-500">Technical Skills</p>
              <p class="font-medium text-red-600">
                {{ implode(', ', json_decode($skills->profile_settings, true)['technical_skills'] ?? []) ?: 'Update' }}
              </p>
            </div>
            <div>
              <p class="text-gray-500">Soft Skills</p>
              <p class="font-medium">{{ implode(', ',json_decode($skills->profile_settings, true)['soft_skills'] ?? []) ?: 'Update' }}</p>
            </div>
            <div>
              <p class="text-gray-500">Skill Level</p>
              <p class="font-medium">{{ json_decode($skills->profile_settings,true)['skill_level'] ?? 'Update' }}</p>
            </div>
            <div>
              <p class="text-gray-500">Interests</p>
              <p class="font-medium">{{ implode(', ',json_decode($skills->profile_settings, true)['interests']) ?? 'Update' }}</p>
            </div>
            <div>
              <p class="text-gray-500">Availability</p>
              <p class="font-medium">{{ json_decode($skills->profile_settings,true)['availability'] ?? 'Update' }}</p>
            </div>
            <div>
              <p class="text-gray-500">Years of Experience</p>
              <p class="font-medium">{{ json_decode($skills->profile_settings,true)['years_of_experience'] ?? 'Update' }}</p>
            </div>
          </div>

          <!-- Bio -->
          <div>
            <p class="text-gray-500">Bio</p>
            <p class="mt-1 text-gray-700 text-sm">{{ json_decode($skills->profile_settings,true)['bio'] ?? 'Update' }}</p>
          </div>

          <!-- Links -->
          <div class="space-y-2">
            <div>
              <i class="fab fa-github text-gray-700 mr-2"></i>
              <a href="{{ json_decode($skills->profile_settings, true)['github'] ?? '#' }}" target="_blank" class="text-blue-600 hover:underline break-all">GitHub</a>
            </div>
            <div>
              <i class="fas fa-code text-gray-700 mr-2"></i>
              <a href="{{ json_decode($skills->profile_settings,true)['leetcode'] ?? '#' }}" target="_blank" class="text-blue-600 hover:underline break-all">LeetCode</a>
            </div>
            <div>
              <i class="fab fa-linkedin text-gray-700 mr-2"></i>
              <a href="{{ json_decode($skills->profile_settings,true)['linkedin'] ?? '#' }}" target="_blank" class="text-blue-600 hover:underline break-all">LinkedIn</a>
            </div>
          </div>

          <!-- Button -->
          <div class="pt-4">
            <a href="/profile/edit" class="inline-block bg-cyan-600 hover:bg-cyan-700 text-white font-medium px-6 py-2.5 rounded-xl shadow transition-all text-sm md:text-base">
              Update Profile
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
