<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>Update Profile</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen py-10 px-4">

  <div class="max-w-4xl mx-auto bg-white shadow-2xl rounded-2xl overflow-hidden">
    <!-- Header -->
    <div class="bg-gradient-to-r from-cyan-600 to-blue-600 px-8 py-6">
      <h1 class="text-3xl font-bold text-white">Update Your Profile</h1>
      <p class="text-cyan-100 mt-1">Maintain your up-to-date professional info</p>
    </div>

    <!-- Form -->
    <form action="/profile/update" method="POST" enctype="multipart/form-data" class="p-8 space-y-10">
      @csrf

      <!-- Profile Image + Info -->
      <section class="grid md:grid-cols-3 gap-8">
        <div>
          <label class="block text-sm font-medium mb-2">Profile Image</label>
          <input type="file" name="profile_image" id="profile_image"
                 class="w-full text-sm text-gray-700 file:py-2 file:px-4 file:border file:border-gray-300 file:rounded-lg file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
        </div>

        <div class="md:col-span-2 space-y-5">
          <div>
            <label for="name" class="block text-sm font-medium mb-1">Full Name</label>
            <input type="text" id="name" name="name" value="{{Auth::user()->name}}"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500">
          </div>

          <div>
            <label class="block text-sm font-medium mb-1">Profession(s)</label>
            <input type="text" name="profession" value="{{ implode(', ', json_decode($skills->profile_settings, true)['profession']) }}"
                   placeholder="e.g. Developer, Designer"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500">
          </div>
        </div>
      </section>

      <!-- Social Links -->
      <section class="grid md:grid-cols-2 gap-6">
        <div>
          <label for="github" class="block text-sm font-medium mb-1">GitHub</label>
          <input type="url" id="github" name="github" placeholder="https://github.com/yourusername"
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500">
        </div>
        <div>
          <label for="leetcode" class="block text-sm font-medium mb-1">LeetCode</label>
          <input type="url" id="leetcode" name="leetcode" placeholder="https://leetcode.com/yourusername"
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500">
        </div>
        <div>
          <label for="linkedin" class="block text-sm font-medium mb-1">LinkedIn</label>
          <input type="url" id="linkedin" name="linkedin" placeholder="https://linkedin.com/in/yourprofile"
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500">
        </div>
        <div>
          <label for="resume" class="block text-sm font-medium mb-1">Resume (PDF)</label>
          <input type="file" id="resume" name="resume" accept=".pdf"
                 class="w-full text-sm file:py-2 file:px-4 file:border file:border-gray-300 file:rounded-lg file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
        </div>
      </section>

      <!-- Skills & Experience -->
      <section class="space-y-5">
        <h2 class="text-xl font-semibold text-gray-700 border-b pb-2">Skills & Expertise</h2>

        <div class="grid md:grid-cols-2 gap-6">
          <div>
            <label class="block text-sm font-medium mb-1">Technical Skills</label>
            <input type="text" name="technical_skills"
                   value="{{ implode(', ',json_decode($skills->profile_settings, true)['technical_skills']) }}"
                   placeholder="e.g. JavaScript, Python"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500">
          </div>
          <div>
            <label class="block text-sm font-medium mb-1">Soft Skills</label>
            <input type="text" name="soft_skills" placeholder="e.g. Leadership, Communication"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500">
          </div>
          <div>
            <label class="block text-sm font-medium mb-1">Skill Level</label>
            <select name="skill_level"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500">
              <option value="Beginner">Beginner</option>
              <option value="Intermediate" selected>Intermediate</option>
              <option value="Expert">Expert</option>
            </select>
          </div>
          <div>
            <label class="block text-sm font-medium mb-1">Years of Experience</label>
            <input type="number" min="0" name="years_of_experience" value="3"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500">
          </div>
        </div>
      </section>

      <!-- Preferences -->
      <section class="space-y-5">
        <h2 class="text-xl font-semibold text-gray-700 border-b pb-2">Preferences</h2>

        <div class="grid md:grid-cols-2 gap-6">
          <div>
            <label class="block text-sm font-medium mb-1">Interests</label>
            <input type="text" name="interests"
                   value="{{ implode(', ', json_decode($skills->profile_settings, true)['interests'] ?? '[]') ?: 'Update' }}"
                   placeholder="e.g. Open Source, AI"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500">
          </div>
          <div>
            <label class="block text-sm font-medium mb-1">Availability</label>
            <input type="text" name="availability" placeholder="e.g. Weekends, Evenings"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500">
          </div>
        </div>
      </section>

      <!-- Bio -->
      <div>
        <label for="bio" class="block text-sm font-medium mb-1">About You</label>
        <textarea id="bio" name="bio" rows="4" placeholder="Tell us about yourself"
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500"></textarea>
      </div>

      <!-- Buttons -->
      <div class="flex justify-between items-center pt-4">
        <a href="{{ url()->previous() }}"
           class="text-gray-600 border border-gray-300 px-5 py-2 rounded-lg hover:bg-gray-100 transition">
          Cancel
        </a>
        <button type="submit"
                class="bg-cyan-600 hover:bg-cyan-700 text-white font-semibold px-6 py-2 rounded-lg shadow-md transition">
          Save Changes
        </button>
      </div>
    </form>
  </div>

</body>
</html>
