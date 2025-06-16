<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>TeamCollab - Change Password</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>
<body class="bg-[#f8fafc] text-gray-900 min-h-screen flex">

  <!-- Sidebar -->
  @include('layout.aside')

  <!-- Main Content -->
  <main class="flex-1 p-4 md:p-8">
    <div class="max-w-md mx-auto bg-white rounded-2xl shadow-lg border overflow-hidden" id="form-card">

      <!-- Flash Message -->
      @if(session('success'))
        <div id="flash-message"
             class="bg-emerald-50 text-emerald-700 text-sm absolute top-4 left-1/2 transform -translate-x-1/2 px-6 py-3 rounded-lg border border-emerald-100 flex items-center gap-2">
          <i class="fas fa-check-circle"></i>
          {{ session('success') }}
        </div>
      @endif

      <!-- Header -->
      <div class="bg-blue-500 p-6 text-white rounded-t-2xl flex justify-between items-center">
        <div>
          <h1 class="text-2xl font-bold">Change Password</h1>
          <p class="text-sm text-blue-100">Secure your account with a new password</p>
        </div>
        <button id="toggle-dark" class="w-9 h-9 flex items-center justify-center rounded-full hover:bg-blue-400 transition">
          <i class="fas fa-moon"></i>
        </button>
      </div>

      <!-- Form -->
      <div class="p-6 space-y-6">
        <form id="password-form" method="POST" action="/resetPassword">
          @csrf

          <!-- Current Password -->
          <div class="space-y-1">
            <label for="current_password" class="font-medium">Current Password</label>
            <div class="relative">
              <input type="password" name="current_password" id="current_password" required
                     class="w-full px-4 py-2.5 pr-12 border rounded-lg focus:ring-2 focus:ring-blue-500" />
              <button type="button" class="toggle-password absolute right-3 top-1/2 -translate-y-1/2" data-target="#current_password">
                <i class="fas fa-eye"></i>
              </button>
            </div>
          </div>

          <!-- New Password -->
          <div class="space-y-1">
            <label for="new_password" class="font-medium">New Password</label>
            <div class="relative">
              <input type="password" name="new_password" id="new_password" required
                     class="w-full px-4 py-2.5 pr-12 border rounded-lg focus:ring-2 focus:ring-blue-500" />
              <button type="button" class="toggle-password absolute right-3 top-1/2 -translate-y-1/2" data-target="#new_password">
                <i class="fas fa-eye"></i>
              </button>
            </div>
            <div class="flex items-center gap-2 mt-1">
              <div class="flex-1 h-1.5 bg-gray-200 rounded-full overflow-hidden">
                <div id="strength-bar" class="h-full transition-all duration-300 bg-red-500 w-0"></div>
              </div>
              <span id="strength-text" class="text-xs text-red-500">Weak</span>
            </div>
          </div>

          <!-- Confirm Password -->
          <div class="space-y-1">
            <label for="new_password_confirmation" class="font-medium">Confirm Password</label>
            <div class="relative">
              <input type="password" name="new_password_confirmation" id="new_password_confirmation" required
                     class="w-full px-4 py-2.5 pr-12 border rounded-lg focus:ring-2 focus:ring-blue-500" />
              <button type="button" class="toggle-password absolute right-3 top-1/2 -translate-y-1/2" data-target="#new_password_confirmation">
                <i class="fas fa-eye"></i>
              </button>
            </div>
            <p id="match-warning" class="text-sm text-red-500 mt-1 hidden">
              <i class="fas fa-exclamation-circle"></i> Passwords don't match
            </p>
          </div>

          <!-- Submit -->
          <div class="pt-4">
            <button type="submit" id="submit-btn"
              class="w-full py-2.5 rounded-lg bg-blue-500 hover:bg-blue-600 text-white font-semibold transition">
              Update Password
            </button>
          </div>
        </form>
      </div>

      <!-- Requirements -->
      <div class="bg-gray-100 p-6 border-t rounded-b-2xl">
        <h3 class="font-semibold mb-2">Password Requirements</h3>
        <ul class="text-sm space-y-1 text-gray-600">
          <li><i class="fas fa-check-circle text-green-500 mr-2"></i> Minimum 8 characters</li>
          <li><i class="fas fa-check-circle text-green-500 mr-2"></i> At least one uppercase letter</li>
          <li><i class="fas fa-check-circle text-green-500 mr-2"></i> At least one number</li>
          <li><i class="fas fa-check-circle text-green-500 mr-2"></i> At least one special character</li>
        </ul>
      </div>

    </div>
  </main>

  <script>
    $(function () {
      // Flash message auto-hide
      setTimeout(() => $('#flash-message').fadeOut(), 3000);

      // Dark mode toggle
      let isDark = localStorage.getItem('darkMode') === 'true';
      if (isDark) $('html').addClass('dark');
      $('#toggle-dark').on('click', function () {
        isDark = !isDark;
        $('html').toggleClass('dark', isDark);
        localStorage.setItem('darkMode', isDark);
        $(this).find('i').toggleClass('fa-moon fa-sun');
      });

      // Toggle password visibility
      $('.toggle-password').on('click', function () {
        const input = $($(this).data('target'));
        const icon = $(this).find('i');
        const type = input.attr('type') === 'password' ? 'text' : 'password';
        input.attr('type', type);
        icon.toggleClass('fa-eye fa-eye-slash');
      });

      function updateStrength(password) {
        let strength = 0;
        if (password.length >= 8) strength++;
        if (/[A-Z]/.test(password)) strength++;
        if (/[0-9]/.test(password)) strength++;
        if (/[^A-Za-z0-9]/.test(password)) strength++;

        const bar = $('#strength-bar');
        const text = $('#strength-text');

        bar.width(`${strength * 25}%`);
        text.removeClass('text-red-500 text-yellow-500 text-green-500');

        if (strength <= 1) {
          bar.addClass('bg-red-500');
          text.addClass('text-red-500').text('Weak');
        } else if (strength === 2) {
          bar.removeClass('bg-red-500').addClass('bg-yellow-500');
          text.addClass('text-yellow-500').text('Medium');
        } else {
          bar.removeClass('bg-yellow-500').addClass('bg-green-500');
          text.addClass('text-green-500').text('Strong');
        }
      }

      function checkMatch() {
        const pass = $('#new_password').val();
        const confirm = $('#new_password_confirmation').val();
        if (confirm && pass !== confirm) {
          $('#match-warning').removeClass('hidden');
          $('#submit-btn').prop('disabled', true).addClass('opacity-50 cursor-not-allowed');
        } else {
          $('#match-warning').addClass('hidden');
          $('#submit-btn').prop('disabled', false).removeClass('opacity-50 cursor-not-allowed');
        }
      }

      $('#new_password').on('input', function () {
        updateStrength(this.value);
        checkMatch();
      });

      $('#new_password_confirmation').on('input', checkMatch);

      $('#password-form').on('submit', function (e) {
        if ($('#new_password').val() !== $('#new_password_confirmation').val()) {
          e.preventDefault();
        }
      });
    });
  </script>
</body>
</html>
