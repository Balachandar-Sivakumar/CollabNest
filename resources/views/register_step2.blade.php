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
      <div x-data="{ professionInput: '', selectedProfessions: [] }" 
     x-init="$watch('professionInput', v => selectedProfessions = v.split(',').map(p => p.trim()).filter(Boolean))">
  <label class="block font-semibold text-gray-700 mb-2 text-lg">Profession(s)</label>
  <input type="text" x-model="professionInput" placeholder="e.g. Developer, Designer"
         class="w-full px-3 py-2 border border-gray-300 rounded text-sm text-black focus:ring-1 focus:ring-cyan-400" />
  <template x-for="(p, i) in selectedProfessions" :key="i">
    <input type="hidden" name="profession[]" :value="p">
  </template>
</div>


          <!-- Skills Dropdown -->
           <div x-data="{ skillsInput: '', selectedSkills: [] }" 
     x-init="$watch('skillsInput', v => selectedSkills = v.split(',').map(s => s.trim()).filter(Boolean))">
  <label class="block font-semibold text-gray-700 mb-2 text-lg">Technical Skills</label>
  <input type="text" x-model="skillsInput" placeholder="e.g. PHP, Laravel, VueJS"
         class="w-full px-3 py-2 border border-gray-300 rounded text-sm text-black focus:ring-1 focus:ring-cyan-400" />
  <template x-for="(s, i) in selectedSkills" :key="i">
    <input type="hidden" name="skills[]" :value="s">
  </template>
</div>


          <!-- Interests Dropdown -->
        <div x-data="{ input: '', interests: [] }" 
     x-init="$watch('input', v => interests = v.split(',').map(i => i.trim()).filter(Boolean))">
  <label class="block font-semibold text-gray-700 mb-2 text-lg">Interests</label>
  <input type="text" x-model="input" placeholder="e.g. AI, Web3, HealthTech"
         class="w-full px-3 py-2 border border-gray-300 rounded text-sm text-black focus:ring-1 focus:ring-cyan-400" />
  <template x-for="(i, idx) in interests" :key="idx">
    <input type="hidden" name="interests[]" :value="i">
  </template>
</div>


        <!-- Availability Dropdown -->
<div class="mt-6">
  <label class="block font-semibold text-gray-700 mb-2 text-lg">Availability</label>
  <select name="availability"
          class="w-full border border-gray-300 rounded px-3 py-2 mb-2 text-sm text-black focus:outline-none focus:ring-1 focus:ring-cyan-400">
    <option value="" disabled selected>Select Availability</option>
    <option value="Weekdays">Weekdays</option>
    <option value="Weekends">Weekends</option>
    <option value="Full-time">Full-time</option>
    <option value="Part-time">Part-time</option>
    <option value="Freelance">Freelance</option>
    <option value="Night shifts">Night shifts</option>
    <option value="Remote Only">Remote Only</option>
    <option value="Onsite Only">Onsite Only</option>
    <option value="Flexible">Flexible</option> <!-- new option -->
  </select>
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
