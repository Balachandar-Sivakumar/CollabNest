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
  <div class="max-w-4xl mx-auto p-6 space-y-6">

    <!-- Team Details -->
    <div class="bg-white shadow-md rounded-2xl p-6">
        <h2 class="text-xl font-semibold mb-4 text-gray-800">Team Details</h2>
        <p class="text-sm text-gray-700">
            <!-- Replace with dynamic data -->
            Team Name: Arichuvadi<br>
            Created On: June 1, 2025<br>
            Status: Active<br>
            Description: A Tamil learning-based board game project.
        </p>
    </div>

    <!-- Comments -->
    <div class="bg-white shadow-md rounded-2xl p-6">
        <h2 class="text-xl font-semibold mb-4 text-gray-800">Comments</h2>
        <div class="space-y-3 h-60 overflow-y-auto border border-gray-200 rounded-lg p-3 bg-gray-50">
            <!-- Dynamic comments -->
            <div class="text-sm text-gray-700">
                <strong>John:</strong> Let’s finalize the UI mockups by Friday.
            </div>
            <div class="text-sm text-gray-700">
                <strong>Mythila:</strong> Started work on the Laravel backend.
            </div>
        </div>

        <!-- Add comment box -->
        <form class="mt-4">
            <textarea class="w-full p-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Write a comment..."></textarea>
            <button type="submit" class="mt-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                Post
            </button>
        </form>
    </div>

    <!-- Team Members -->
    <div class="bg-white shadow-md rounded-2xl p-6">
        <h2 class="text-xl font-semibold mb-4 text-gray-800">Team Members</h2>
        <ul class="space-y-2 text-sm text-gray-700">
            <li>👤 Mythila (Team Lead)</li>
            <li>👤 Arjun (Backend Developer)</li>
            <li>👤 Divya (Frontend Developer)</li>
        </ul>
    </div>

</div>


</div>



  
</body>
</html>
