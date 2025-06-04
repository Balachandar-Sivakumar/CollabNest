<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>Create Account</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
    .tag {
      transition: all 0.2s ease;
    }
    .tag:hover {
      transform: translateY(-1px);
    }
    .remove-tag {
      transition: all 0.2s ease;
    }
    .remove-tag:hover {
      transform: scale(1.2);
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
            <div id="errorMessage1" class="text-red-600 text-sm bg-red-300 text-center mb-4 hidden"></div>
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

            <!-- Profession Input -->
            <div class="profession-container">
              <label class="block font-semibold text-gray-700 mb-2 text-lg">Profession(s)</label>
              <div class="flex items-center">
                <input type="text" id="professionInput" placeholder="e.g. Developer, Designer"
                       class="flex-1 px-3 py-2 border border-gray-300 rounded text-sm text-black focus:ring-1 focus:ring-cyan-400"/>
                <button type="button" id="addProfession" class="ml-2 px-3 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                  <i class="fas fa-plus"></i>
                </button>
              </div>
              <div id="professionTags" class="flex flex-wrap mt-2"></div>
              <div id="professionHiddenInputs"></div>
            </div>
              <ul id="profession_suggession"
                  class="absolute mt-1 bg-white border border-gray-300 rounded-md shadow-lg z-10 max-h-48 overflow-auto ">
              </ul>
            <!-- Skills Input -->
            <div class="mt-4 skills-container">
              <label class="block font-semibold text-gray-700 mb-2 text-lg">Technical Skills</label>
              <div class="flex items-center">
                <input type="text" id="skillsInput" placeholder="e.g. PHP, Laravel, VueJS"
                       class="flex-1 px-3 py-2 border border-gray-300 rounded text-sm text-black focus:ring-1 focus:ring-cyan-400"/>
                <button type="button" id="addSkill" class="ml-2 px-3 py-2 bg-indigo-500 text-white rounded hover:bg-indigo-600">
                  <i class="fas fa-plus"></i>
                </button>
              </div>
              <div id="skillsTags" class="flex flex-wrap mt-2"></div>
              <div id="skillsHiddenInputs"></div>
            </div>

              <ul id="skills_suggession"
                  class="absolute mt-1 bg-white border border-gray-300 rounded-md shadow-lg z-10 max-h-48 overflow-auto ">
              </ul>

            <!-- Interests Input -->
            <div class="mt-4 interests-container">
              <label class="block font-semibold text-gray-700 mb-2 text-lg">Interests</label>
              <div class="flex items-center">
                <input type="text" id="interestsInput" placeholder="e.g. AI, Web3, HealthTech"
                       class="flex-1 px-3 py-2 border border-gray-300 rounded text-sm text-black focus:ring-1 focus:ring-cyan-400"/>
                <button type="button" id="addInterest" class="ml-2 px-3 py-2 bg-purple-500 text-white rounded hover:bg-purple-600">
                  <i class="fas fa-plus"></i>
                </button>
              </div>
              <div id="interestsTags" class="flex flex-wrap mt-2"></div>
              <div id="interestsHiddenInputs"></div>
            </div>

             <ul id="interests_suggession"
                  class="absolute mt-1 bg-white border border-gray-300 rounded-md shadow-lg z-10 max-h-48 overflow-auto ">
              </ul>

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

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 
  <script>

$(function () {
  const form = $('#detailsForm'), step1 = $('.step_1'), step2 = $('.step_2'),
        nextBtn = $('#nextbtn'), errorBox1 = $('#errorMessage1'), errorBox2 = $('#errorMessage'),
        password = $('#password'), confirmPassword = $('#confirm_password'), passwordError = $('#password_error');

  // ✅ Global tag arrays
 let professionTags = [],
  skillsTags = [],
  interestsTags = [];

  confirmPassword.on('input', () => passwordError.toggleClass('hidden', password.val() === confirmPassword.val()));

  nextBtn.on('click', e => {
    e.preventDefault();
    const name = form.find('[name="name"]').val().trim(),
          email = form.find('[name="email"]').val().trim(),
          pwd = password.val(), confirmPwd = confirmPassword.val(),
          agreed = $('#termsCheckbox').is(':checked');

    if (!name) return showError(errorBox1, 'Full name is required.');
    if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) return showError(errorBox1, 'A valid email is required.');
    if (pwd.length < 6) return showError(errorBox1, 'Password must be at least 6 characters.');
    if (pwd !== confirmPwd) return showError(errorBox1, 'Passwords do not match.');
    if (!agreed) return showError(errorBox1, 'You must agree to the Terms of Service.');

    errorBox1.addClass('hidden');
    step1.addClass('hidden');
    step2.removeClass('hidden');
  });

  $('#prevbtn').on('click', () => {
    step2.addClass('hidden');
    step1.removeClass('hidden');
  });

  form.on('submit', e => {
    if (!professionTags.length) return stopSubmit(e, 'Please enter at least one profession.');
    if (!skillsTags.length) return stopSubmit(e, 'Please enter at least one skill.');
    if (!interestsTags.length) return stopSubmit(e, 'Please enter at least one interest.');
    if (!$('[name="availability"]').val()) return stopSubmit(e, 'Please select your availability.');
    errorBox2.addClass('hidden');
  });

  function stopSubmit(e, msg) {
    e.preventDefault();
    showError(errorBox2, msg);
  }

  function setupTagInput(inputId, addBtnId, containerId, hiddenId, tagArray, color, name) {
    const input = $(inputId), addBtn = $(addBtnId), tagsBox = $(containerId), hiddenBox = $(hiddenId);

    input.on('keypress', e => {
      if (e.which === 13 || e.which === 44) {
        e.preventDefault();
        addTag();
      }
    });

    addBtn.on('click', addTag);

    function addTag() {
      const val = input.val().trim();
      if (val && !tagArray.includes(val)) {
        tagArray.push(val);
        updateTags();
        input.val('');
      }
    }

    function updateTags() {
      tagsBox.empty(); hiddenBox.empty();
      tagArray.forEach((tag, i) => {
        tagsBox.append(`
          <span class="tag inline-flex items-center px-2 py-1 mr-1 mb-1 text-xs font-medium rounded bg-${color}-100 text-${color}-800">
            ${tag}
            <button type="button" class="ml-1 text-${color}-500 hover:text-${color}-700 remove-tag" data-index="${i}" data-type="${name}">
              <i class="fas fa-times"></i>
            </button>
          </span>`);
        hiddenBox.append(`<input type="hidden" name="${name}[]" value="${tag}">`);
      });
    }

    return { updateTags };
  }

  
  let prof = setupTagInput('#professionInput', '#addProfession', '#professionTags', '#professionHiddenInputs', professionTags, 'blue', 'profession');
  let skills = setupTagInput('#skillsInput', '#addSkill', '#skillsTags', '#skillsHiddenInputs', skillsTags, 'indigo', 'skills');
  let interests = setupTagInput('#interestsInput', '#addInterest', '#interestsTags', '#interestsHiddenInputs', interestsTags, 'purple', 'interests');

  $(document).on('click', '.remove-tag', function () {
    const index = $(this).data('index'), type = $(this).data('type');
    if (type === 'profession') { professionTags.splice(index, 1); prof.updateTags(); }
    else if (type === 'skills') { skillsTags.splice(index, 1); skills.updateTags(); }
    else if (type === 'interests') { interestsTags.splice(index, 1); interests.updateTags(); }
  });

  function showError(box, msg) {
    box.text(msg).removeClass('hidden');
  }

 function setupTagSuggestion({ inputId, listId, fetchUrl, dataKey, tagArray, updateFunc }) {
  const $input = $(`#${inputId}`);
  const $list = $(`#${listId}`);

  $input.on('input', () => {
    const query = $input.val().trim();
    $list.empty();
    if (!query) return;

    fetch(`${fetchUrl}${encodeURIComponent(query)}`)
      .then(res => res.json())
      .then(data => {
        if (!data.length) return $list.append('<li class="p-2 text-gray-500">No matches found</li>');
        data.forEach(item => {
          $list.append(`<li class="p-2 hover:bg-gray-100 cursor-pointer" data-${dataKey}="${item}">${item}</li>`);
        });
      })
      .catch(err => console.error('Fetch error:', err));
  });

  $(document).on('click', `#${listId} li`, function () {
    const selected = $(this).data(dataKey);
    if (selected && !tagArray.includes(selected)) {
      tagArray.push(selected);
      updateFunc();
    }
    $input.val('');
    $list.empty();
  });
}

// Setup suggestions
setupTagSuggestion({
  inputId: 'professionInput',
  listId: 'profession_suggession',
  fetchUrl: '/profession/search?q=',
  dataKey: 'profession',
  tagArray: professionTags,
  updateFunc: prof.updateTags
});

setupTagSuggestion({
  inputId: 'skillsInput',
  listId: 'skills_suggession',
  fetchUrl: '/skills/search?q=',
  dataKey: 'skill',
  tagArray: skillsTags,
  updateFunc: skills.updateTags
});

setupTagSuggestion({
  inputId: 'interestsInput',
  listId: 'interests_suggession',
  fetchUrl: '/interests/search?q=',
  dataKey: 'interest',
  tagArray: interestsTags,
  updateFunc: interests.updateTags
});

      

});

 
  
  </script>

</body>
</html>