<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>TeamCollab Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet"/>
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body class="bg-[#f8fafc] text-gray-900 min-h-screen flex">

  <!-- Sidebar -->
 @include('layout.aside')

  <div class="mb-8">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Requirement Documents</h2>
    <div id="documents-container">
      <!-- Documents will be added here dynamically -->
    </div>
    <button 
      type="button" 
      id="add-document" 
      class="mt-2 inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
    >
      + Add Document
    </button>
  </div>


       <div class="col-span-2 md:col-span-1">
        <label for="project_logo" class="block text-sm font-medium text-gray-700 mb-1">Project Logo</label>
        <div class="flex items-center">
          <input 
            type="file" 
            id="project_logo" 
            name="project_logo" 
            accept="image/*"
            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
          >
        </div>
      </div>

        <div class="mb-8">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Project URLs</h2>
    <div id="urls-container">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-3">
        <input 
          type="text" 
          placeholder="Label (e.g. GitHub Repo)" 
          class="px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
        >
        <input 
          type="url" 
          placeholder="URL" 
          class="md:col-span-2 px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
        >
      </div>
    </div>
    <button 
      type="button" 
      id="add-url" 
      class="mt-2 inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
    >
      + Add Another URL
    </button>
  </div>

  <script>
     document.getElementById('add-document').addEventListener('click', function() {
    const container = document.getElementById('documents-container');
    const div = document.createElement('div');
    div.className = 'flex items-center mb-2';
    div.innerHTML = `
      <input 
        type="file" 
        name="requirement_documents[]" 
        class="flex-1 px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
      >
      <button type="button" class="ml-2 text-red-500 hover:text-red-700" onclick="this.parentNode.remove()">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
        </svg>
      </button>
    `;
    container.appendChild(div);
  });

  document.getElementById('add-url').addEventListener('click', function() {
    const container = document.getElementById('urls-container');
    const div = document.createElement('div');
    div.className = 'grid grid-cols-1 md:grid-cols-3 gap-4 mb-3';
    div.innerHTML = `
      <input 
        type="text" 
        name="project_urls[][label]" 
        placeholder="Label (e.g. GitHub Repo)" 
        class="px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
      >
      <input 
        type="url" 
        name="project_urls[][url]" 
        placeholder="URL" 
        class="md:col-span-2 px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
      >
    `;
    container.appendChild(div);
  });

  </script>
  
</body>
</html>
