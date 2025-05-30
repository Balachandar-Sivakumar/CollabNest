<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>Create Account</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body>
  <div class="relative min-h-screen flex items-center justify-center bg-gradient-to-r from-indigo-500 to-teal-400">
    <img alt="People working together" class="absolute inset-0 w-full h-full object-cover opacity-30"
         src="https://storage.googleapis.com/a1aa/image/6a58b975-69ac-4dd7-2152-e73aa1eb888d.jpg"/>

    <div class="relative z-10 max-w-4xl w-full shadow-lg bg-white flex flex-col md:flex-row rounded-[30px]">
      
      <!-- Left Panel -->
      <div class="flex-1 bg-[#f0f3ff] p-10 md:p-16 flex flex-col items-center justify-center rounded-tl-[30px] rounded-bl-[30px]">
        <img alt="Illustration"
             class="mb-6 max-w-[240px] w-full"
             src="https://img.freepik.com/free-vector/privacy-policy-concept-illustration_114360-7853.jpg"
             width="240" height="200"/>
        <h3 class="text-black font-semibold text-lg mb-2 text-center">Description</h3>
        <p class="text-xs text-gray-400 text-center max-w-xs mb-6">
          Create an account to showcase your skills, connect with collaborators, and bring your ideas to life with real-time project tracking and collaboration tools.
        </p>
      </div>

      <!-- Right Panel: Form -->
      <div class="flex-1 p-10 md:p-16 flex flex-col justify-center">
        <form method="POST" action="/register" class="w-full max-w-md mx-auto" id="detailsForm">
          @csrf

          <!-- Step 1 -->
          <div class="step_1">
            <div id="errorMessage1" class="text-red-600 text-sm bg-red-300 text-center  mb-4 hidden"></div>
            <h2 class="text-center text-black text-lg font-extrabold mb-8">Create Account</h2>

            <input name="name" value="{{ old('name') }}"
                   class="w-full border border-gray-300 rounded px-3 py-2 mb-2 text-sm text-black focus:outline-none focus:ring-1 focus:ring-cyan-400"
                   type="text" placeholder="Full Name"/>

            <input name="email" value="{{ old('email') }}"
                   class="w-full border border-gray-300 rounded px-3 py-2 mb-2 text-sm text-black focus:outline-none focus:ring-1 focus:ring-cyan-400"
                   type="email" placeholder="Your Email"/>

            <input name="password"
                   class="w-full border border-gray-300 rounded px-3 py-2 mb-2 text-sm text-black focus:outline-none focus:ring-1 focus:ring-cyan-400"
                   type="password" placeholder="Password" id="password"/>

            <input name="password_confirmation"
                   class="w-full border border-gray-300 rounded px-3 py-2 mb-1 text-sm text-black focus:outline-none focus:ring-1 focus:ring-cyan-400"
                   type="password" placeholder="Repeat your password" id="confirm_password"/>

            <p id="password_error" class="text-red-500 text-xs mb-2 hidden">Passwords do not match</p>

            <label class="flex items-center text-xs text-gray-600 mb-6">
              <input class="mr-2 w-4 h-4 border border-gray-300 rounded" type="checkbox" required id="termsCheckbox"/>
              <span>I agree to the </span>
              <a class="ml-1 underline text-gray-700 hover:text-cyan-600" href="#">Terms of Service</a>
            </label>

            <button id="nextbtn"
                    class="w-full bg-gradient-to-r from-indigo-400 to-teal-300 text-white font-semibold text-xs py-3 rounded hover:from-indigo-500 hover:to-teal-400 transition-colors">
              Next
            </button>

            <p class="text-center text-xs text-gray-700 mt-8 font-normal">
              Already have an account?
              <a class="font-extrabold underline" href="/navlogin">Login here</a>
            </p>
          </div>

          <!-- Step 2 -->

            <div class="step_2 hidden">
              <div id="errorMessage" class="text-red-600 bg-red-300 text-center text-white text-sm mb-4 hidden"></div>

              <div x-data="{ professionInput: '', selectedProfessions: [] }"
                   x-init="$watch('professionInput', v => selectedProfessions = v.split(',').map(p => p.trim()).filter(Boolean))">
                <label class="block font-semibold text-gray-700 mb-2 text-lg">Profession(s)</label>
                <input type="text" x-model="professionInput" placeholder="e.g. Developer, Designer"
                       class="w-full px-3 py-2 border border-gray-300 rounded text-sm text-black focus:ring-1 focus:ring-cyan-400"/>
                <template x-for="(p, i) in selectedProfessions" :key="i">
                  <input type="hidden" name="profession[]" :value="p">
                </template>
              </div>

              <div class="mt-4" x-data="{ skillsInput: '', selectedSkills: [] }"
                   x-init="$watch('skillsInput', v => selectedSkills = v.split(',').map(s => s.trim()).filter(Boolean))">
                <label class="block font-semibold text-gray-700 mb-2 text-lg">Technical Skills</label>
                <input type="text" x-model="skillsInput" placeholder="e.g. PHP, Laravel, VueJS"
                       class="w-full px-3 py-2 border border-gray-300 rounded text-sm text-black focus:ring-1 focus:ring-cyan-400"/>
                <template x-for="(s, i) in selectedSkills" :key="i">
                  <input type="hidden" name="skills[]" :value="s">
                </template>
              </div>

              <div class="mt-4" x-data="{ input: '', interests: [] }"
                   x-init="$watch('input', v => interests = v.split(',').map(i => i.trim()).filter(Boolean))">
                <label class="block font-semibold text-gray-700 mb-2 text-lg">Interests</label>
                <input type="text" x-model="input" placeholder="e.g. AI, Web3, HealthTech"
                       class="w-full px-3 py-2 border border-gray-300 rounded text-sm text-black focus:ring-1 focus:ring-cyan-400"/>
                <template x-for="(i, idx) in interests" :key="idx">
                  <input type="hidden" name="interests[]" :value="i">
                </template>
              </div>

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
                  <option value="Flexible">Flexible</option>
                </select>
              </div>

              <div class="pt-6 flex flex-col gap-2">
                <button type="button" id="prevbtn"
                        class="w-full bg-gray-300 text-gray-800 font-semibold text-xs py-3 rounded hover:bg-gray-400 transition-colors">
                  Previous
                </button>

                <button type="submit"
                        class="w-full bg-gradient-to-r from-indigo-400 to-teal-300 text-white font-semibold text-xs py-3 rounded hover:from-indigo-500 hover:to-teal-400 transition-colors">
                  Complete Registration
                </button>
              </div>
            </div>

        </form>
      </div>
    </div>
  </div>

  <!-- JavaScript Validation Logic -->
  <script>
    const form = document.getElementById('detailsForm');
    const step1 = document.querySelector('.step_1');
    const step2 = document.querySelector('.step_2');
    const nextBtn = document.getElementById('nextbtn');
    const errorBox1 = document.getElementById('errorMessage1');
    const errorBox2 = document.getElementById('errorMessage');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirm_password');
    const passwordError = document.getElementById('password_error');
    

    step2.classList.add('hidden');

  
    confirmPassword.addEventListener('input', () => {
      passwordError.classList.toggle('hidden', password.value === confirmPassword.value);
    });

    nextBtn.addEventListener('click', e => {
      e.preventDefault();

      const name = form.name.value.trim();
      const email = form.email.value.trim();
      const pwd = password.value;
      const confirmPwd = confirmPassword.value;
      const agreed = document.getElementById('termsCheckbox').checked;

      if (!name) return showError(errorBox1, 'Full name is required.');
      if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) return showError(errorBox1, 'A valid email is required.');
      if (pwd.length < 6) return showError(errorBox1, 'Password must be at least 6 characters.');
      if (pwd !== confirmPwd) return showError(errorBox1, 'Passwords do not match.');
      if (!agreed) return showError(errorBox1, 'You must agree to the Terms of Service.');

      errorBox1.classList.add('hidden');
      step1.classList.add('hidden');
      step2.classList.remove('hidden');

      localStorage.setItem('flag',JSON.stringify(true));
    });

    addEventListener('DOMContentLoaded',()=>{
        let flag = JSON.parse(localStorage.getItem('flag')) || [];

        if(flag){
           errorBox1.classList.add('hidden');
            step1.classList.add('hidden');
            step2.classList.remove('hidden');
        }
    })

    // STEP 2 Validation
    form.addEventListener('submit', e => {
      const profession = document.querySelector('input[x-model="professionInput"]').value.trim();
      const skills = document.querySelector('input[x-model="skillsInput"]').value.trim();
      const interests = document.querySelector('input[x-model="input"]').value.trim();
      const availability = form.availability.value;

      if (!profession) return blockSubmit(e, errorBox2, 'Please enter at least one profession.');
      if (!skills) return blockSubmit(e, errorBox2, 'Please enter at least one skill.');
      if (!interests) return blockSubmit(e, errorBox2, 'Please enter at least one interest.');
      if (!availability) return blockSubmit(e, errorBox2, 'Please select your availability.');

      errorBox2.classList.add('hidden');

      localStorage.clear();
    });

    function showError(box, message) {
      box.textContent = message;
      box.classList.remove('hidden');
    }

    function blockSubmit(e, box, message) {
      e.preventDefault();
      showError(box, message);
    }

    const prevBtn = document.getElementById('prevbtn');

        prevBtn.addEventListener('click', () => {
          step2.classList.add('hidden');
          step1.classList.remove('hidden');
        });
  </script>
</body>
</html>
