<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>TeamCollab Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
    #skills_suggession {
      scrollbar-width: thin;
      scrollbar-color: #e2e8f0 #f8fafc;
    }
    #skills_suggession::-webkit-scrollbar {
      width: 6px;
    }
    #skills_suggession::-webkit-scrollbar-track {
      background: #f8fafc;
    }
    #skills_suggession::-webkit-scrollbar-thumb {
      background-color: #e2e8f0;
      border-radius: 3px;
    }
  </style>
</head>
<body class="bg-[#f8fafc] text-gray-900 min-h-screen flex">

  <!-- Sidebar -->
  @include('layout.aside')
   
  <!-- Main Form -->
  <form action="/UpdateProject/{{$project->id}}" method="POST" enctype="multipart/form-data"
        class="w-full max-w-5xl bg-white shadow-xl mx-auto my-6 rounded-xl p-8">
    @csrf

      
 <h2 class="text-2xl font-bold text-gray-800">Update Project</h2>
    

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <!-- Title -->
      <div class="col-span-1">
        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Project Title*</label>
        <input type="text" name="title" id="title" value="{{ old('title', $project->title) }}" required
               class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
      </div>

      <!-- Logo -->
      <div class="col-span-1">
        <label for="logo" class="block text-sm font-medium text-gray-700 mb-2">Project Logo</label>
        <div class="flex items-center space-x-4">
          @if($project->logo)
            <img src="{{ asset('storage/' . $project->logo) }}" alt="Project Logo" class="w-12 h-12 rounded-lg object-cover">
          @endif
          <input type="file" name="logo" id="logo" accept="image/*"
                 class="flex-1 text-sm file:bg-blue-50 file:text-blue-700 file:px-4 file:py-2 file:rounded-lg file:border-0 file:text-sm file:font-medium hover:file:bg-blue-100 transition">
        </div>
      </div>

      <!-- Description -->
      <div class="col-span-1 md:col-span-2">
        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
        <textarea name="description" id="description" rows="3"
                  class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">{{ old('description', $project->description) }}</textarea>
      </div>

      <!-- Goals -->
      <div class="col-span-1 md:col-span-2">
        <label for="goals" class="block text-sm font-medium text-gray-700 mb-2">Project Goals</label>
        <textarea name="goals" id="goals" rows="3"
                  class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">{{ old('goals', $project->goals) }}</textarea>
      </div>

          <!-- Requirement Documents -->
      <div class="col-span-1">
        <label class="block text-sm font-medium text-gray-700 mb-2">Current Documents</label>
        <div class="space-y-2 mb-3">
          @foreach(json_decode($project->requirement_documents ?? '[]') as $doc)
            <div class="flex items-center justify-between bg-gray-50 px-3 py-2 rounded-lg">
              <span class="text-sm truncate">{{ basename($doc) }}</span>
              <button type="button" class="text-red-500 hover:text-red-700" onclick="removeDocument(this, '{{ $doc }}')">
                <i class="fas fa-trash-alt"></i>
              </button>
            </div>
          @endforeach
        </div>
        <label for="requirement_documents" class="block text-sm font-medium text-gray-700 mb-2">Add New Documents</label>
        <input type="file" name="requirement_documents[]" id="requirement_documents" multiple accept=".pdf,.doc,.docx"
               class="w-full text-sm file:bg-blue-50 file:text-blue-700 file:px-4 file:py-2 file:rounded-lg file:border-0 file:text-sm file:font-medium hover:file:bg-blue-100 transition">
        <p class="text-xs text-gray-500 mt-2">PDF, DOC, DOCX files accepted (max 5MB each)</p>
        <input type="hidden" name="removed_documents" id="removed_documents" value="">
      </div>

      @php 

            $tech_skills =[];
            foreach(json_decode($project->skills_required ?? '[]') as $skill){
                $tech_skills[]=\App\Models\Skill::where('id',$skill)->value('skill');
            }

        @endphp
            
      <!-- Skills -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Skills Required</label>
            <div class="input-tag-container flex flex-wrap items-center gap-2 px-3 py-2 border border-gray-300 rounded-lg focus-within:ring-2 focus-within:ring-blue-500 focus-within:border-blue-500">
              <div id="technical-skills-tags" class="flex flex-wrap gap-2">               
                    <div class="tag inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                     
                      <button type="button" class="tag-remove ml-1.5 text-indigo-600 hover:text-indigo-800">
                        <i class="fas fa-times text-xs"></i>
                      </button>
                    </div>

              </div>
              <input type="text" id="technical-skills-input" placeholder="e.g. JavaScript, Python" 
                     class="flex-1 min-w-[100px] border-0 focus:ring-0 px-1 py-1 text-sm">
              <button type="button" id="add-technical-skill" class="text-indigo-600 hover:text-indigo-800">
                <i class="fas fa-plus-circle"></i>
              </button>
              <input type="hidden" name="technical_skills" id="technical-skills-values" 
                     value="{{ implode(',', $tech_skills) ?? '' }}">
            </div>
             <ul id="skills_suggession"
                  class="absolute mt-1 bg-white border border-gray-300 rounded-md shadow-lg z-10 max-h-48 overflow-auto ">
              </ul>
          </div>

      <!-- Git Repo -->
      <div class="col-span-1">
        <label for="github" class="block text-sm font-medium text-gray-700 mb-2">GitHub URL</label>
        <input type="url" name="github" id="github" value="{{ old('github', json_decode($project->project_url,true)['github']) }}" placeholder="https://github.com/your-project"
               class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
      </div>

      <!-- Trello link -->
      <div class="col-span-1">
        <label for="trello" class="block text-sm font-medium text-gray-700 mb-2">Trello URL</label>
        <input type="url" name="trello" id="trello" value="{{ old('trello', json_decode($project->project_url,true)['trello']) }}" placeholder="https://trello.com/b/your-board"
               class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
      </div>

      <!-- Visibility -->
      <div class="col-span-1">
        <label for="is_private" class="block text-sm font-medium text-gray-700 mb-2">Visibility</label>
        <select name="is_private" id="is_private"
                class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
          <option value="0" {{ $project->is_private == 0 ? 'selected' : '' }}>Public (Visible to everyone)</option>
          <option value="1" {{ $project->is_private == 1 ? 'selected' : '' }}>Private (Only team members)</option>
        </select>
      </div>

    </div>

     
     
      <div class="flex space-x-8 w-full justify-between mt-9">
        <a href="{{ url()->previous() }}" 
           class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
          <i class="fas fa-times mr-2"></i> Cancel
        </a>
        <button type="submit" 
                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow transition">
          <i class="fas fa-save mr-2"></i> Save Changes
        </button>
  
    </div>
  </form>

  <script>


function setupTagSystem(inputSelector, addButtonSelector, tagsContainerSelector, hiddenInputSelector, colorClasses) {
        let tags = $(hiddenInputSelector).val() ? $(hiddenInputSelector).val().split(',') : [];

        function updateTags() {
          $(tagsContainerSelector).empty();
          tags.forEach(tag => {
            if (tag.trim()) {
              $(tagsContainerSelector).append(`
                <div class="tag inline-flex items-center px-3 py-1 rounded-full text-xs font-medium ${colorClasses.bg} ${colorClasses.text}">
                  ${tag.trim()}
                  <button type="button" class="tag-remove ml-1.5 ${colorClasses.hover}">
                    <i class="fas fa-times text-xs"></i>
                  </button>
                </div>
              `);
            }
          });
          $(hiddenInputSelector).val(tags.join(','));
        }

        $(addButtonSelector).on('click', function() {
          const val = $(inputSelector).val().trim();
          if (val && !tags.includes(val)) {
            tags.push(val);
            updateTags();
            $(inputSelector).val('');
          }
        });

        $(inputSelector).on('keypress', function(e) {
          if (e.which === 13) { // Enter key
            e.preventDefault();
            $(addButtonSelector).click();
          }
        });

        $(document).on('click', `${tagsContainerSelector} .tag-remove`, function() {
          const tagText = $(this).parent().text().trim();
          tags = tags.filter(t => t.trim() !== tagText);
          updateTags();
        });

        // Initialize tags on page load
        updateTags();
      }

        setupTagSystem('#technical-skills-input', '#add-technical-skill', '#technical-skills-tags', '#technical-skills-values', {
        bg: 'bg-indigo-100',
        text: 'text-indigo-800',
        hover: 'text-indigo-600 hover:text-indigo-800'
      });

      

        function setupSuggestion(inputId, listId, fetchUrl, clickBtnId, keyName = '') {
         
        $(`#${inputId}`).on('input', function () {
          console.log('blaalala')
          const query = $(this).val().trim();
          const list = $(`#${listId}`);
          list.empty();
          if (!query) return;
        
          fetch(`${fetchUrl}${encodeURIComponent(query)}`)
            .then(res => res.json())
            .then(data => {
              if (!data.length) return list.append('<li class="p-2 text-gray-500">No matches found</li>');
              data.forEach(item => {
                const text = typeof item === 'object' ? item[keyName] : item;
                list.append(`<li class="p-2 hover:bg-gray-100 cursor-pointer">${text}</li>`);
              });
            })
            .catch(err => console.error('Fetch error:', err));
        });
      
        $(document).on('click', `#${listId} li`, function () {
          const selected = $(this).text();
          $(`#${inputId}`).val(selected);
          $(`#${listId}`).empty();
          $(`#${clickBtnId}`).click();
        });
      }

       setupSuggestion('technical-skills-input', 'skills_suggession', '/skills/search?q=', 'add-technical-skill');

       let required_documets = $('#requirement_documents').val().split(',');

       let removedDocuments =[];

    function removeDocument(button, docPath) {
      removedDocuments.push(docPath);
      $('#removed_documents').val(JSON.stringify(removedDocuments));
      $(button).closest('div').remove();
    }

  </script>
</body>
</html>