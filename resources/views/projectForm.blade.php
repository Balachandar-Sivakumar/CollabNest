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


<form action="/CreateProject" method="POST" enctype="multipart/form-data"
        class="w-full h-full max-w-5xl bg-white shadow-xl rounded-xl p-10 overflow-y-auto">
    @csrf

    <h2 class="text-3xl font-bold text-gray-800 mb-8">Create New Project</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <!-- Title -->
      <div class="col-span-1">
        <label for="title" class="block text-sm font-semibold mb-1">Project Title</label>
        <input type="text" name="title" id="title" required
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-200">
      </div>

      <!-- Git Repo -->
      <div class="col-span-1">
        <label for="git_repo_url" class="block text-sm font-semibold mb-1">Git Repository URL</label>
        <input type="url" name="git_repo_url" id="git_repo_url" placeholder="https://github.com/user/repo"
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-200">
      </div>

      <!-- Description -->
      <div class="col-span-1 md:col-span-2">
        <label for="description" class="block text-sm font-semibold mb-1">Description</label>
        <textarea name="description" id="description" rows="3"
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-200"></textarea>
      </div>

      <!-- Goals -->
      <div class="col-span-1 md:col-span-2">
        <label for="goals" class="block text-sm font-semibold mb-1">Project Goals</label>
        <textarea name="goals" id="goals" rows="3"
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-200"></textarea>
      </div>

      <!-- Requirement Document -->
      <div class="col-span-1">
        <label for="requirement_documents" class="block text-sm font-semibold mb-1">Requirement Document (PDF)</label>
        <input type="file" name="requirement_documents" id="requirement_documents" accept=".pdf,.doc,.docx"
               class="w-full text-sm file:bg-blue-600 file:text-white file:px-4 file:py-2 file:rounded-lg file:border-0 hover:file:bg-blue-700">
      </div>

      <!-- Skills -->
      <div class="col-span-1">
        <label for="skills_required" class="block text-sm font-semibold mb-1">Skills Required (comma-separated)</label>
        <input type="text" name="skills_required" id="skills_required" placeholder="e.g. Laravel, Vue.js"
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-200">
      </div>

      <!-- Visibility -->
      <div class="col-span-1">
        <label for="is_private" class="block text-sm font-semibold mb-1">Visibility</label>
        <select name="is_private" id="is_private"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-200">
          <option value="0">Public</option>
          <option value="1">Private</option>
        </select>
      </div>
    </div>

    <!-- Submit -->
    <div class="mt-8 flex justify-end">
      <button type="submit"
              class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition">
        <i class="fas fa-plus mr-2"></i> Create Project
      </button>
    </div>
  </form>

  
</body>
</html>
