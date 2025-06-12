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
    .document-preview {
      max-height: 200px;
      overflow-y: auto;
    }
    .document-item {
      transition: all 0.2s ease;
    }
    .document-item:hover {
      background-color: #f8fafc;
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
        <input type="text" name="title" id="title" 
               class="w-full px-4 py-2.5 text-base border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-400 transition">
      </div>

      <!-- Logo -->
      <div class="col-span-1">
        <label for="logo" class="block text-base font-medium text-gray-700 mb-1.5">Project Logo</label>
        <input type="file" name="logo" id="logo" accept="image/*"
               class="w-full text-base file:bg-blue-500 file:text-white file:px-4 file:py-2.5 file:rounded-lg file:border-0 file:font-medium hover:file:bg-blue-600 file:transition">
        <div id="logo-preview" class="mt-2 hidden">
          <p class="text-sm font-medium text-gray-700">Preview:</p>
          <img id="logo-preview-image" class="mt-1 w-20 h-20 object-cover rounded-lg border border-gray-200">
        </div>
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
      <div class="col-span-1 md:col-span-2">
        <label class="block text-base font-medium text-gray-700 mb-1.5">Requirement Documents</label>
        
        <!-- Document upload interface -->
        <div class="space-y-3">
          <div id="document-fields" class="space-y-3">
            <!-- Initial document field -->
            <div class="document-group flex flex-col md:flex-row gap-3 items-start md:items-end">
              <div class="flex-1 w-full">
                <label class="block text-sm font-medium text-gray-700 mb-1">Document Name</label>
                <input type="text" name="doc_names[]" placeholder="e.g. Project Specifications" 
                       class="w-full px-3 py-2 text-base border border-gray-300 rounded-lg" required>
              </div>
              <div class="flex-1 w-full">
                <label class="block text-sm font-medium text-gray-700 mb-1">File</label>
                <div class="flex items-center gap-2">
                  <input type="file" name="requirement_documents[]" 
                         class="flex-1 text-base file:bg-blue-500 file:text-white file:px-3 file:py-2 file:rounded-lg file:border-0 file:font-medium hover:file:bg-blue-600 file:transition" 
                         accept=".pdf,.doc,.docx" required>
                  <button type="button" onclick="removeField(this)" 
                          class="px-3 py-2 text-red-600 hover:text-red-800 transition">
                    <i class="fas fa-trash"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          
          <button type="button" onclick="addField()" 
                  class="flex items-center px-3 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
            <i class="fas fa-plus mr-2"></i> Add Another Document
          </button>
          
          <p class="text-sm text-gray-500">PDF, DOC, DOCX files accepted (max 5MB each)</p>
        </div>
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
            class="absolute z-10 mt-1 w-full max-w-3xl bg-white border border-gray-200 max-h-48 rounded-lg shadow-lg overflow-y-auto hidden">
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
    // Document Management
    function addField() {
      const container = document.getElementById('document-fields');
      const field = document.createElement('div');
      field.className = 'document-group flex flex-col md:flex-row gap-3 items-start md:items-end';
      field.innerHTML = `
        <div class="flex-1 w-full">
         
          <input type="text" name="doc_names[]" placeholder="e.g. Technical Requirements" 
                 class="w-full px-3 py-2 text-base border border-gray-300 rounded-lg" required>
        </div>
        <div class="flex-1 w-full">
          
          <div class="flex items-center gap-2">
            <input type="file" name="requirement_documents[]" 
                   class="flex-1 text-base file:bg-blue-500 file:text-white file:px-3 file:py-2 file:rounded-lg file:border-0 file:font-medium hover:file:bg-blue-600 file:transition" 
                   accept=".pdf,.doc,.docx" required>
            <button type="button" onclick="removeField(this)" 
                    class="px-3 py-2 text-red-600 hover:text-red-800 transition">
              <i class="fas fa-trash"></i>
            </button>
          </div>
        </div>
      `;
      container.appendChild(field);
    }

    function removeField(button) {
      const fieldGroup = button.closest('.document-group');
      if (document.querySelectorAll('.document-group').length > 1) {
        fieldGroup.remove();
      } else {
        // Reset the first field instead of removing it
        const inputs = fieldGroup.querySelectorAll('input');
        inputs[0].value = '';
        inputs[1].value = '';
      }
    }

    // Logo Preview
    document.getElementById('logo').addEventListener('change', function(e) {
      const preview = document.getElementById('logo-preview');
      const previewImage = document.getElementById('logo-preview-image');
      
      if (this.files && this.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
          previewImage.src = e.target.result;
          preview.classList.remove('hidden');
        }
        reader.readAsDataURL(this.files[0]);
      }
    });

    // Skills Tag Management
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

    // Skills Suggestion
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

    // Form Validation
    $('form').on('submit', function(e) {
      let isValid = true;
      const errors = [];
      
      // Validate Title
      if (!$('#title').val().trim()) {
        errors.push('Project title is required');
        $('#title').addClass('border-red-500');
        isValid = false;
      } else {
        $('#title').removeClass('border-red-500');
      }
      
      // Validate Skills
      if (skillsTag.length === 0) {
        errors.push('At least one skill is required');
        $('#skillsInput').addClass('border-red-500');
        isValid = false;
      } else {
        $('#skillsInput').removeClass('border-red-500');
      }
      
      // Validate Document Names
      const docNames = $('input[name="doc_names[]"]').filter(function() {
        return $(this).val().trim() === '';
      });
      
      if (docNames.length > 0) {
        errors.push('All documents must have a name');
        docNames.addClass('border-red-500');
        isValid = false;
      } else {
        $('input[name="doc_names[]"]').removeClass('border-red-500');
      }
      
      // Validate Document Files
      const docFiles = $('input[name="requirement_documents[]"]').filter(function() {
        return !this.files || this.files.length === 0;
      });
      
      if (docFiles.length > 0) {
        errors.push('All documents must have a file selected');
        docFiles.addClass('border-red-500');
        isValid = false;
      } else {
        $('input[name="requirement_documents[]"]').removeClass('border-red-500');
      }
      
      // Show errors if any
      if (!isValid) {
        e.preventDefault();
        
        // Remove any existing error messages
        $('.error-message').remove();
        
        if (errors.length > 0) {
          const errorHtml = `
            <div class="error-message mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded">
              <div class="flex items-center">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <strong>Please fix the following issues:</strong>
              </div>
              <ul class="mt-2 ml-6 list-disc">
                ${errors.map(error => `<li>${error}</li>`).join('')}
              </ul>
            </div>
          `;
          
          $(errorHtml).insertAfter('h2');
        }
      }
    });
  </script>
</body>
</html>