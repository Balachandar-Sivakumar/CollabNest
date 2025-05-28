<!DOCTYPE html>
<html lang="en" x-data="{}">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Professional Details</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
      body {
    font-family: 'Inter', sans-serif;
  }
   
  </style>
</head>
<body class="bg-gray-100 relative">

<div class="relative min-h-screen flex items-center justify-center bg-gradient-to-r from-indigo-500 to-teal-400">
  <img alt="People working together" class="absolute inset-0 w-full h-full object-cover opacity-30"
         src="https://storage.googleapis.com/a1aa/image/6a58b975-69ac-4dd7-2152-e73aa1eb888d.jpg"/>

  <!-- <div class="absolute inset-0 bg-black opacity-40 z-0"></div> -->

  <!-- Combined Section -->
  <div class="relative z-10 p-4 max-w-4xl w-full shadow-lg overflow-hidden">
    <div class="relative z-10 bg-white flex flex-col md:flex-row rounded-[30px]">

      <!-- Left Side -->
      <div class="flex-1 bg-[#f0f3ff] rounded-[30px] md:w-[50%] p-10 flex flex-col items-center justify-center">
        <img alt="Illustration showing hands holding lightbulb and charts representing project progress"
             class="mb-6 max-w-[240px] w-full" height="200"
             src="https://img.freepik.com/free-vector/personal-site-concept-illustration_114360-2577.jpg?uid=R156815013&ga=GA1.1.1574424695.1745626358&semt=ais_hybrid&w=740" width="240"/>
        <h3 class="text-black font-semibold text-lg mb-2 text-center">Description</h3>
        <p class="text-xs text-gray-400 text-center max-w-xs mb-6">
          Provide your personal and professional details to help us match you with the best opportunities and collaborations based on your skills and interests.
        </p>
      </div>

      <!-- Right Side: Form -->
      <div class="w-full md:w-[50%] p-10">
        <h2 class="text-center text-black text-lg font-extrabold mb-8">Professional Details</h2>

        <form method="POST" action="/step_two">
          @csrf 
       <!-- Profession Dropdown -->
<div x-data="{ open: false, selectedProfession: '' }" class="mb-6">
  <label class="block font-semibold text-gray-700 mb-2 text-lg">Profession</label>
  <div class="relative">
    <button type="button"
            @click="open = !open"
            class="w-full border border-gray-300 rounded px-3 py-2 mb-2 text-sm text-black text-left focus:outline-none focus:ring-1 focus:ring-cyan-400">
      <span x-text="selectedProfession ? selectedProfession : 'Select Profession'"></span>
      <svg class="w-5 h-5 inline float-right" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
      </svg>
    </button>

    <div x-show="open" @click.outside="open = false"
         class="absolute z-10 mt-2 w-full bg-white border border-gray-300 rounded-lg shadow-lg p-2 max-h-60 overflow-y-auto">
      <template x-for="option in ['Developer', 'Designer', 'Product Manager', 'Data Scientist', 'DevOps Engineer']" :key="option">
        <div @click="selectedProfession = option; open = false"
             class="cursor-pointer px-4 py-2 hover:bg-cyan-100 rounded text-gray-800"
             :class="{ 'bg-cyan-200 font-semibold': selectedProfession === option }">
          <span x-text="option"></span>
        </div>
      </template>
    </div>
  </div>
  <input type="hidden" name="profession" :value="selectedProfession">
</div>

          <!-- Skills Dropdown -->
          <div x-data="{ open: false, selectedSkills: [] }">
            <label class="block font-semibold text-gray-700 mb-2 text-lg">Skills</label>
            <div class="relative">
              <button type="button"
                      class="w-full border border-gray-300 rounded px-3 py-2 mb-2 text-sm text-black text-left focus:outline-none focus:ring-1 focus:ring-cyan-400"
                      @click="open = !open">
                <span x-text="selectedSkills.length > 0 ? selectedSkills.join(', ') : 'Select Skills'"></span>
                <svg class="w-5 h-5 inline float-right" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </button>

              <div x-show="open"
                   @click.outside="open = false"
                   class="absolute z-10 mt-2 w-full max-h-64 overflow-y-auto border border-gray-300 bg-white rounded-lg shadow-lg p-4 space-y-2">
                <template x-for="skill in ['PHP', 'Laravel', 'VueJS', 'React', 'Node.js', 'Python', 'Django', 'MySQL', 'PostgreSQL', 'Docker']" :key="skill">
                  <label class="flex items-center space-x-3 text-gray-800">
                    <input type="checkbox" :value="skill" name="skills[]" x-model="selectedSkills"
                           class="border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <span x-text="skill"></span>
                  </label>
                </template>
              </div>
            </div>
          </div>

          <!-- Interests Dropdown -->
          <div x-data="{ open: false, selectedInterests: [] }" class="mt-6">
            <label class="block font-semibold text-gray-700 mb-2 text-lg">Interests</label>
            <div class="relative">
              <button type="button"
                      class="w-full border border-gray-300 rounded px-3 py-2 mb-2 text-sm text-black text-left focus:outline-none focus:ring-1 focus:ring-cyan-400"
                      @click="open = !open">
                <span x-text="selectedInterests.length > 0 ? selectedInterests.join(', ') : 'Select Interests'"></span>
                <svg class="w-5 h-5 inline float-right" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </button>

              <div x-show="open"
                   @click.outside="open = false"
                   class="absolute z-10 mt-2 w-full max-h-64 overflow-y-auto border border-gray-300 bg-white rounded-lg shadow-lg p-4 space-y-2">
                <template x-for="interest in ['AI', 'Web3', 'HealthTech', 'EdTech', 'FinTech', 'SaaS', 'Cybersecurity', 'Game Dev', 'Climate Tech']" :key="interest">
                  <label class="flex items-center space-x-3 text-gray-800">
                    <input type="checkbox" :value="interest" name="interests[]" x-model="selectedInterests"
                           class="border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <span x-text="interest"></span>
                  </label>
                </template>
              </div>
            </div>
          </div>

        <!-- Availability Dropdown -->
<div x-data="{ open: false, selectedAvailability: '' }" class="mt-6">
  <label class="block font-semibold text-gray-700 mb-2 text-lg">Availability</label>
  <div class="relative">
    <button type="button"
            @click="open = !open"
            class="w-full border border-gray-300 rounded px-3 py-2 mb-2 text-sm text-black text-left focus:outline-none focus:ring-1 focus:ring-cyan-400">
      <span x-text="selectedAvailability ? selectedAvailability : 'Select Availability'"></span>
      <svg class="w-5 h-5 inline float-right" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
      </svg>
    </button>

    <div x-show="open"
         @click.outside="open = false"
         class="absolute z-10 mt-2 w-full bg-white border border-gray-300 rounded-lg shadow-lg p-2 max-h-60 overflow-y-auto">
      <template x-for="option in ['Weekdays', 'Weekends', 'Full-time', 'Part-time', 'Freelance', 'Night shifts', 'Remote Only', 'Onsite Only']" :key="option">
        <div @click="selectedAvailability = option; open = false"
             class="cursor-pointer px-4 py-2 hover:bg-cyan-100 rounded text-gray-800"
             :class="{ 'bg-cyan-200 font-semibold': selectedAvailability === option }">
          <input type="radio" :value="option" name="availability" x-model="selectedAvailability" class="hidden">
          <span x-text="option"></span>
        </div>
      </template>
    </div>
  </div>
</div>


          <!-- Submit -->
          <div class="pt-6">
            <button type="submit"
                    class="w-full bg-gradient-to-r from-indigo-400 to-teal-300 text-white font-semibold text-xs py-3 rounded hover:from-indigo-500 hover:to-teal-400 transition-colors">
              Complete Registration
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>
