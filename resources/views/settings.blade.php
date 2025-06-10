<!DOCTYPE html>
<html lang="en" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))" :class="{ 'dark': darkMode }">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>TeamCollab Dashboard - Settings</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/alpinejs" defer></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet"/>
  <style>
    body { font-family: 'Inter', sans-serif; }
    .dark .dark\:bg-gray-900 { background-color: #1a202c; }
    .dark .dark\:text-white { color: #fff; }
    .dark .dark\:bg-gray-800 { background-color: #2d3748; }
    .dark .dark\:border-gray-700 { border-color: #4a5568; }
    .dark .dark\:placeholder-gray-400::placeholder { color: #a0aec0; }
  </style>
</head>
<body class="bg-[#f8fafc] dark:bg-gray-900 text-gray-900 dark:text-white min-h-screen flex">

  <!-- Sidebar -->
  @include('layout.aside')

  <!-- Main Content -->
  <main class="flex-1 p-8">
    <div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-md p-8 border dark:border-gray-700">
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold">Settings</h1>
        <!-- Dark/Light Mode Toggle -->
        <button @click="darkMode = !darkMode" class="focus:outline-none text-xl" :title="darkMode ? 'Switch to Light Mode' : 'Switch to Dark Mode'">
          <span x-show="!darkMode"><i class="fas fa-moon"></i></span>
          <span x-show="darkMode"><i class="fas fa-sun"></i></span>
        </button>
      </div>
      <form method="POST" action="{{ route('settings.update') }}">
        @csrf
        @method('PUT')
        <!-- Display Name -->
        <div class="mb-4">
          <label class="block font-bold mb-2" for="display_name">Display Name</label>
          <input type="text" id="display_name" name="display_name" value="{{ old('display_name', Auth::user()->name) }}"
                 class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-900 dark:text-white dark:border-gray-700 dark:placeholder-gray-400"/>
        </div>
        <!-- Email -->
        <div class="mb-4">
          <label class="block font-bold mb-2" for="email">Email</label>
          <input type="email" id="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                 class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-900 dark:text-white dark:border-gray-700 dark:placeholder-gray-400"/>
        </div>
        <!-- Change Password -->
        <div class="mb-4">
          <label class="block font-bold mb-2" for="password">New Password</label>
          <input type="password" id="password" name="password"
                 class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-900 dark:text-white dark:border-gray-700 dark:placeholder-gray-400" placeholder="Leave blank to keep current"/>
        </div>
        <!-- Notification Settings (example) -->
        <div class="mb-4">
          <label class="block font-bold mb-2">Notifications</label>
          <label class="inline-flex items-center">
            <input type="checkbox" name="email_notifications" class="form-checkbox" {{ Auth::user()->email_notifications ? 'checked' : '' }}>
            <span class="ml-2">Enable Email Notifications</span>
          </label>
        </div>
        <!-- Add more settings fields as needed -->

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
          Save Changes
        </button>
      </form>

      <!-- Customer Support Section -->
      <div class="mt-10 border-t pt-6 dark:border-gray-700">
        <h2 class="text-xl font-semibold mb-2">Customer Support</h2>
        <p class="mb-2">Need help? Contact our support team:</p>
        <ul>
          <li><i class="fas fa-envelope mr-2"></i>Email: <a href="mailto:support@teamcollab.com" class="underline text-blue-600 dark:text-blue-400">support@teamcollab.com</a></li>
          <li><i class="fas fa-phone mr-2"></i>Phone: <a href="tel:+1234567890" class="underline text-blue-600 dark:text-blue-400">+1 234 567 890</a></li>
          <li><i class="fab fa-whatsapp mr-2"></i>WhatsApp: <a href="https://wa.me/1234567890" class="underline text-blue-600 dark:text-blue-400">Chat on WhatsApp</a></li>
        </ul>
      </div>
    </div>
  </main>
</body>
</html>
