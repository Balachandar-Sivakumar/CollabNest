<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>Create Project | TeamCollab</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: {
              50: '#f0f9ff',
              100: '#e0f2fe',
              500: '#3b82f6',
              600: '#2563eb',
            },
            secondary: {
              50: '#f5f3ff',
              100: '#ede9fe',
              500: '#8b5cf6',
            },
            accent: {
              50: '#ecfdf5',
              100: '#d1fae5',
              500: '#10b981',
            }
          },
          boxShadow: {
            'input-focus': '0 0 0 3px rgba(59, 130, 246, 0.25)',
            'card': '0 4px 20px rgba(0, 0, 0, 0.08)'
          }
        }
      }
    }
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f8fafc;
    }
    .form-container {
      transition: all 0.3s ease;
    }
    .form-input {
      transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    .tag {
      transition: all 0.2s ease;
    }
    .tag:hover {
      transform: translateY(-1px);
    }
    .document-preview {
      scrollbar-width: thin;
      scrollbar-color: #cbd5e1 #f1f5f9;
    }
    .document-preview::-webkit-scrollbar {
      width: 6px;
    }
    .document-preview::-webkit-scrollbar-track {
      background: #f1f5f9;
    }
    .document-preview::-webkit-scrollbar-thumb {
      background-color: #cbd5e1;
      border-radius: 3px;
    }
  </style>
</head>

<body class="min-h-screen flex">
  <!-- Sidebar -->
  @include('layout.aside')

  <!-- Main Content -->
  <main class="flex-1 p-6 overflow-y-auto">
    <div class="max-w-5xl mx-auto">
      <!-- Form Container -->
      <form action="/CreateProject" method="POST" enctype="multipart/form-data"
            class="form-container bg-white rounded-2xl shadow-card p-8">
        @csrf

        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
          <div>
            <h2 class="text-2xl font-bold text-gray-800">Create New Project</h2>
            <p class="text-gray-500 mt-1">Fill in the details to start collaborating</p>
          </div>
          <div class="mt-4 md:mt-0">
            <button type="submit"
                    class="px-6 py-3 bg-primary-500 hover:bg-primary-600 text-white font-medium rounded-lg shadow-md transition-all transform hover:-translate-y-0.5 flex items-center gap-2">
              <i class="fas fa-plus"></i>
              <span>Create Project</span>
            </button>
          </div>
        </div>

        <!-- Grid Layout -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <!-- Project Title -->
          <div class="col-span-1">
            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Project Title*</label>
            <div class="relative">
              <input type="text" name="title" id="title" required
                     class="form-input w-full px-4 py-3 text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                     placeholder="e.g. E-commerce Platform">
              <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                <i class="fas fa-heading text-gray-400"></i>
              </div>
            </div>
          </div>

          <!-- Project Logo -->
          <div class="col-span-1">
            <label for="logo" class="block text-sm font-medium text-gray-700 mb-2">Project Logo</label>
            <div class="flex items-center gap-4">
              <label for="logo" class="cursor-pointer">
                <div class="flex items-center justify-center w-16 h-16 rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 hover:bg-gray-100 transition">
                  <i class="fas fa-camera text-gray-400 text-xl"></i>
                </div>
                <input type="file" name="logo" id="logo" accept="image/*" class="hidden">
              </label>
              <div id="logo-preview" class="hidden">
                <div class="relative">
                  <img id="logo-preview-image" class="w-16 h-16 object-cover rounded-lg border border-gray-200">
                  <button type="button" onclick="clearLogo()" class="absolute -top-2 -right-2 bg-white rounded-full p-1 shadow-sm text-red-500 hover:text-red-700">
                    <i class="fas fa-times text-xs"></i>
                  </button>
                </div>
              </div>
              <div class="text-sm text-gray-500">
                <p>Recommended: 512×512 px</p>
                <p>Max size: 2MB</p>
              </div>
            </div>
          </div>

          <!-- Description -->
          <div class="col-span-1 md:col-span-2">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description*</label>
            <textarea name="description" id="description" rows="3" required
                      class="form-input w-full px-4 py-3 text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                      placeholder="Briefly describe your project..."></textarea>
          </div>

          <!-- Goals -->
          <div class="col-span-1 md:col-span-2">
            <label for="goals" class="block text-sm font-medium text-gray-700 mb-2">Project Goals</label>
            <textarea name="goals" id="goals" rows="3"
                      class="form-input w-full px-4 py-3 text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                      placeholder="What are the main objectives of this project?"></textarea>
          </div>

          <!-- Requirement Documents -->
          <div class="col-span-1 md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-3">Requirement Documents</label>
            
            <div id="document-fields" class="space-y-4">
              <!-- Initial document field -->
              <div class="document-group bg-gray-50 p-4 rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                  <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Document Name*</label>
                    <input type="text" name="doc_names[]" required
                           class="form-input w-full px-3 py-2 text-sm border border-gray-300 rounded-lg"
                           placeholder="e.g. Project Specs">
                  </div>
                  <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">File*</label>
                    <input type="file" name="requirement_documents[]" required
                           class="w-full text-sm file:bg-primary-500 file:text-white file:px-3 file:py-2 file:rounded-lg file:border-0 hover:file:bg-primary-600 file:transition"
                           accept=".pdf,.doc,.docx">
                  </div>
                  <div class="flex items-end">
                    <button type="button" onclick="removeField(this)" 
                            class="px-3 py-2 text-red-500 hover:text-red-700 transition">
                      <i class="fas fa-trash mr-1"></i> Remove
                    </button>
                  </div>
                </div>
              </div>
            </div>
            
            <button type="button" onclick="addField()" 
                    class="mt-3 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition flex items-center gap-2">
              <i class="fas fa-plus"></i> Add Another Document
            </button>
            
            <p class="mt-2 text-xs text-gray-500">Accepted formats: PDF, DOC, DOCX (max 5MB each)</p>
          </div>

          <!-- Skills Required -->
          <div class="col-span-1 md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-2">Skills Required*</label>
            <div class="relative">
              <div class="flex items-center">
                <input type="text" id="skillsInput" 
                       class="form-input flex-1 px-4 py-3 text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                       placeholder="e.g. JavaScript, UI/UX Design">
                <button type="button" id="addSkill" class="ml-2 px-4 py-3 bg-primary-500 text-white rounded-lg hover:bg-primary-600 transition">
                  <i class="fas fa-plus"></i>
                </button>
              </div>
              <div id="skillsTags" class="flex flex-wrap gap-2 mt-3"></div>
              <div id="skillsHiddenInputs"></div>
              <ul id="skills_suggestion"
                  class="absolute z-10 mt-1 w-full bg-white border border-gray-200 rounded-lg shadow-lg max-h-60 overflow-y-auto hidden">
              </ul>
            </div>
          </div>

          <!-- GitHub URL -->
          <div class="col-span-1">
            <label for="github" class="block text-sm font-medium text-gray-700 mb-2">GitHub Repository</label>
            <div class="relative">
              <input type="url" name="github" id="github" 
                     class="form-input w-full px-4 py-3 text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                     placeholder="https://github.com/username/repo">
              <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                <i class="fab fa-github text-gray-400"></i>
              </div>
            </div>
          </div>

          <!-- Trello URL -->
          <div class="col-span-1">
            <label for="trello" class="block text-sm font-medium text-gray-700 mb-2">Trello Board</label>
            <div class="relative">
              <input type="url" name="trello" id="trello" 
                     class="form-input w-full px-4 py-3 text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                     placeholder="https://trello.com/b/board-id">
              <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                <i class="fab fa-trello text-gray-400"></i>
              </div>
            </div>
          </div>

          <!-- Visibility -->
          <div class="col-span-1">
            <label for="is_private" class="block text-sm font-medium text-gray-700 mb-2">Visibility</label>
            <select name="is_private" id="is_private"
                    class="form-input w-full px-4 py-3 text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
              <option value='0'>Public (Visible to everyone)</option>
              <option value='1'>Private (Only team members)</option>
            </select>
          </div>
        </div>
      </form>
    </div>
  </main>

  <script>
    // Document Management
    function addField() {
      const container = document.getElementById('document-fields');
      const field = document.createElement('div');
      field.className = 'document-group bg-gray-50 p-4 rounded-lg';
      field.innerHTML = `
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <div>
            <label class="block text-xs font-medium text-gray-500 mb-1">Document Name*</label>
            <input type="text" name="doc_names[]" required
                   class="form-input w-full px-3 py-2 text-sm border border-gray-300 rounded-lg"
                   placeholder="e.g. Technical Requirements">
          </div>
          <div>
            <label class="block text-xs font-medium text-gray-500 mb-1">File*</label>
            <input type="file" name="requirement_documents[]" required
                   class="w-full text-sm file:bg-primary-500 file:text-white file:px-3 file:py-2 file:rounded-lg file:border-0 hover:file:bg-primary-600 file:transition"
                   accept=".pdf,.doc,.docx">
          </div>
          <div class="flex items-end">
            <button type="button" onclick="removeField(this)" 
                    class="px-3 py-2 text-red-500 hover:text-red-700 transition">
              <i class="fas fa-trash mr-1"></i> Remove
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
        if (this.files[0].size > 2 * 1024 * 1024) {
          alert('File size exceeds 2MB limit');
          this.value = '';
          return;
        }
        
        const reader = new FileReader();
        reader.onload = function(e) {
          previewImage.src = e.target.result;
          preview.classList.remove('hidden');
        }
        reader.readAsDataURL(this.files[0]);
      }
    });

    function clearLogo() {
      document.getElementById('logo').value = '';
      document.getElementById('logo-preview').classList.add('hidden');
    }

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
          $('#skills_suggestion').addClass('hidden');
        }
      }
    
      function updateTags() {
        tagsBox.empty(); 
        hiddenBox.empty();
        tagArray.forEach((tag, i) => {
          tagsBox.append(`
            <span class="tag inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-${color}-100 text-${color}-800">
              ${tag}
              <button type="button" class="ml-1.5 -mr-0.5 text-${color}-500 hover:text-${color}-700 remove-tag" data-index="${i}" data-type="${name}">
                <i class="fas fa-times"></i>
              </button>
            </span>`);
          hiddenBox.append(`<input type="hidden" name="${name}[]" value="${tag}">`);
        });
      }
    
      return { updateTags };
    }

    let skills = setupTagInput('#skillsInput', '#addSkill', '#skillsTags', '#skillsHiddenInputs', skillsTag, 'primary', 'skills_required');

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
            if (!data.length) return $list.append('<li class="p-3 text-gray-500 text-sm">No matches found</li>');
            data.forEach(item => {
              $list.append(`<li class="p-3 hover:bg-gray-100 cursor-pointer text-sm" data-${dataKey}="${item}">${item}</li>`);
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
      listId: 'skills_suggestion',
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
        $('#title').addClass('border-red-500 focus:ring-red-500 focus:border-red-500');
        isValid = false;
      } else {
        $('#title').removeClass('border-red-500 focus:ring-red-500 focus:border-red-500');
      }
      
      // Validate Skills
      if (skillsTag.length === 0) {
        errors.push('At least one skill is required');
        $('#skillsInput').addClass('border-red-500 focus:ring-red-500 focus:border-red-500');
        isValid = false;
      } else {
        $('#skillsInput').removeClass('border-red-500 focus:ring-red-500 focus:border-red-500');
      }
      
      // Validate Description
      if (!$('#description').val().trim()) {
        errors.push('Project description is required');
        $('#description').addClass('border-red-500 focus:ring-red-500 focus:border-red-500');
        isValid = false;
      } else {
        $('#description').removeClass('border-red-500 focus:ring-red-500 focus:border-red-500');
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
                <strong class="font-medium">Please fix the following issues:</strong>
              </div>
              <ul class="mt-2 ml-6 list-disc text-sm">
                ${errors.map(error => `<li>${error}</li>`).join('')}
              </ul>
            </div>
          `;
          
          $(errorHtml).insertAfter('h2');
          
          // Scroll to error message
          $('html, body').animate({
            scrollTop: $('.error-message').offset().top - 20
          }, 300);
        }
      }
    });
  </script>
</body>
</html>