<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>TeamCollab Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet"/>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body class="bg-[#f8fafc] text-gray-900 min-h-screen flex">

  <!-- Sidebar -->
  @include('layout.aside')

<form action="/CreateProject" method="POST" enctype="multipart/form-data"
      class="w-full max-w-5xl bg-white shadow-lg mx-auto mt-4 mb-4 rounded-2xl p-8">
  @csrf

  <h2 class="text-2xl font-bold text-gray-800 mb-6">Create New Project</h2>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
    <!-- Title -->
    <div class="col-span-1">
      <label for="title" class="block text-base font-medium text-gray-700 mb-1.5">Project Title*</label>
      <input type="text" name="title" id="title" required
             class="w-full px-4 py-2.5 text-base border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-400 transition">
    </div>

    <!-- Logo -->
    <div class="col-span-1">
      <label for="logo" class="block text-base font-medium text-gray-700 mb-1.5">Project Logo</label>
      <input type="file" name="logo" id="logo" accept="image/*"
             class="w-full text-base file:bg-blue-500 file:text-white file:px-4 file:py-2.5 file:rounded-lg file:border-0 file:font-medium hover:file:bg-blue-600 file:transition">
    </div>

    <!-- Description -->
    <div class="col-span-1 md:col-span-2">
      <label for="description" class="block text-base font-medium text-gray-700 mb-1.5">Description</label>
      <textarea name="description" id="description" rows="3"
                class="w-full px-4 py-2.5 text-base border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-400 transition"></textarea>
    </div>

    <!-- Goals -->
    <div class="col-span-1 md:col-span-2">
      <label for="goals" class="block text-base font-medium text-gray-700 mb-1.5">Project Goals</label>
      <textarea name="goals" id="goals" rows="3"
                class="w-full px-4 py-2.5 text-base border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-400 transition"></textarea>
    </div>

    <!-- Requirement Documents -->
    <div class="col-span-1">
      <label for="requirement_documents" class="block text-base font-medium text-gray-700 mb-1.5">Requirement Documents</label>
      <input type="file" name="requirement_documents[]" id="requirement_documents" multiple accept=".pdf,.doc,.docx"
             class="w-full text-base file:bg-blue-500 file:text-white file:px-4 file:py-2.5 file:rounded-lg file:border-0 file:font-medium hover:file:bg-blue-600 file:transition">
      <p class="text-sm text-gray-500 mt-1.5">PDF, DOC, DOCX files accepted</p>
    </div>

    <!-- Skills -->
    <div class="col-span-1 md:col-span-2">
      <label class="block text-base font-medium text-gray-700 mb-1.5">Skills Required</label>
      <div class="flex items-center relative">
        <input type="text" id="skillsInput" placeholder="e.g. PHP, Laravel, VueJS"
               class="flex-1 px-4 py-2.5 text-base border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-400 transition">
        <button type="button" id="addSkill" class="ml-2 px-4 py-2.5 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600 transition">
          <i class="fas fa-plus"></i>
        </button>
      </div>
      <div id="skillsTags" class="flex flex-wrap gap-2 mt-3"></div>
      <div id="skillsHiddenInputs"></div>
      <ul id="skills_suggession"
          class="absolute z-10 mt-1 w-full max-w-3xl bg-white border border-gray-200 max-h-48 rounded-lg shadow-lg overflow-y-auto ">
      </ul>
    </div>

    <!-- Git Repo -->
    <div class="col-span-1">
      <label for="github" class="block text-base font-medium text-gray-700 mb-1.5">GitHub URL</label>
      <input type="url" name="github" id="github" placeholder="https://github.com/your-project"
             class="w-full px-4 py-2.5 text-base border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-400 transition">
    </div>

    <!-- Trello link -->
    <div class="col-span-1">
      <label for="trello" class="block text-base font-medium text-gray-700 mb-1.5">Trello URL</label>
      <input type="url" name="trello" id="trello" placeholder="https://trello.com/b/your-board"
             class="w-full px-4 py-2.5 text-base border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-400 transition">
    </div>

    <!-- Visibility -->
    <div class="col-span-1">
      <label for="is_private" class="block text-base font-medium text-gray-700 mb-1.5">Visibility</label>
      <select name="is_private" id="is_private"
              class="w-full px-4 py-2.5 text-base border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-400 transition">
        <option value='0'>Public (Visible to everyone)</option>
        <option value='1'>Private (Only team members)</option>
      </select>
    </div>
  </div>

  <!-- Submit -->
  <div class="mt-10 flex justify-end">
    <button type="submit"
            class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium text-base rounded-lg shadow-md transition transform hover:-translate-y-0.5">
      <i class="fas fa-plus mr-2"></i> Create Project
    </button>
  </div>
</form>

  <script>
    let skillsTag = [];
    
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
          $('#skills_suggession').addClass('hidden');
        }
      }
    
      function updateTags() {
        tagsBox.empty(); 
        hiddenBox.empty();
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

    let skills = setupTagInput('#skillsInput', '#addSkill', '#skillsTags', '#skillsHiddenInputs', skillsTag, 'indigo', 'skills_required');

    $(document).on('click', '.remove-tag', function() {
      let index = $(this).data('index'), type = $(this).data('type');
      if (type === 'skills_required') {
        skillsTag.splice(index, 1);
        skills.updateTags();
      }
    });

    function setupTagSuggestion({ inputId, listId, fetchUrl, dataKey, tagArray, updateFunc }) {
      const $input = $(`#${inputId}`);
      const $list = $(`#${listId}`);
    
      $input.on('input', () => {
        const query = $input.val().trim();
        if (query) {
          $list.removeClass('hidden');
        } else {
          $list.addClass('hidden');
        }
        
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
    
      $(document).on('click', `#${listId} li`, function() {
        const selected = $(this).data(dataKey);
        if (selected && !tagArray.includes(selected)) {
          tagArray.push(selected);
          updateFunc();
        }
        $input.val('');
        $list.addClass('hidden');
      });
      
      // Hide suggestions when clicking outside
      $(document).on('click', function(e) {
        if (!$(e.target).closest(`#${inputId}, #${listId}`).length) {
          $list.addClass('hidden');
        }
      });
    }

    setupTagSuggestion({
      inputId: 'skillsInput',
      listId: 'skills_suggession',
      fetchUrl: '/skills/search?q=',
      dataKey: 'skill',
      tagArray: skillsTag,
      updateFunc: skills.updateTags
    });
  </script>
</body>
</html>