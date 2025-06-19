<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>TeamCollab - Change Password</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
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

      <!-- Response Message Container -->
      <div id="response-message" class="hidden z-10 absolute top-4 left-1/2 transform -translate-x-1/2 px-6 py-3 rounded-lg border text-sm flex items-center gap-2">
        <i class="fas mr-2"></i>
        <span id="response-text"></span>
      </div>

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
        <form id="password-form" method="POST" action="/sendOtp">
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

  <!-- OTP Verification Popup -->
  <form method="POST" action="/ressetPassword" id="otpModal" class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center hidden">
    @csrf
    <div class="bg-white rounded-xl p-6 w-full max-w-md shadow-xl animate-fade-in">

      <!-- Success Message -->
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 text-sm">
        ✅ Success! Please check your email for the OTP.
      </div>

      <h3 class="text-2xl font-bold mb-2 text-gray-800">Verify Your Identity</h3>
      <p class="text-gray-600 mb-6">Enter the 6-digit code sent to your email address.</p>

      <!-- OTP Inputs -->
      <div class="flex justify-between mb-6 space-x-2">
        @for ($i = 0; $i < 6; $i++)
          <input
          type="text"
          maxlength="1"
          name="otp[]"
          class="w-12 h-12 text-2xl text-center border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
          pattern="[0-9]"
          inputmode="numeric"
          autocomplete="one-time-code"
          required>
          @endfor
      </div>

      <div class="flex justify-between items-center">
        <button type="button" class="text-sm text-blue-600 hover:underline focus:outline-none" id="resendOtpBtn">
          Resend Code
        </button>
        <button type="submit" id="verifyBtn" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none">
          Verify
        </button>
      </div>
    </div>
  </form>

  <script>
    $(function() {
      // Flash message auto-hide
      setTimeout(() => $('#flash-message').fadeOut(), 3000);

      // Show response message
      function showResponseMessage(message, type) {
        const responseEl = $('#response-message');
        const textEl = $('#response-text');
        const iconEl = responseEl.find('i');

        // Set message and styling based on type
        textEl.text(message);
        responseEl.removeClass('hidden bg-red-50 text-red-700 border-red-100 bg-green-50 text-green-700 border-green-100');

        if (type === 'error') {
          responseEl.addClass('bg-red-50 text-red-700 border-red-100');
          iconEl.removeClass().addClass('fas fa-exclamation-circle');
        } else {
          responseEl.addClass('bg-green-50 text-green-700 border-green-100');
          iconEl.removeClass().addClass('fas fa-check-circle');
        }

        // Show and auto-hide
        responseEl.removeClass('hidden').fadeIn();
        setTimeout(() => responseEl.fadeOut(), 3000);
      }

      // Dark mode toggle
      let isDark = localStorage.getItem('darkMode') === 'true';
      if (isDark) $('html').addClass('dark');
      $('#toggle-dark').on('click', function() {
        isDark = !isDark;
        $('html').toggleClass('dark', isDark);
        localStorage.setItem('darkMode', isDark);
        $(this).find('i').toggleClass('fa-moon fa-sun');
      });

      // Toggle password visibility
      $('.toggle-password').on('click', function() {
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

      $('#new_password').on('input', function() {
        updateStrength(this.value);
        checkMatch();
      });

      $('#new_password_confirmation').on('input', checkMatch);

      $('#password-form').on('submit', function(e) {
        e.preventDefault();

        fetch('/sendOtp', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
              current_password: $('#current_password').val(),
              new_password: $('#new_password').val(),
            })
          })
          .then(res => res.json())
          .then(data => {
            if (data.error) {
              showResponseMessage(data.error, 'error');
            } else {

              // Optionally reset form on success
              if (data.success) {
                $('#password-form')[0].reset();
                $('#strength-bar').width('0');
                $('#strength-text').removeClass().addClass('text-xs text-red-500').text('Weak');
                openOtpModal()
              }
            }
          })
          .catch(error => {
            console.error('Something went wrong:', error);
            showResponseMessage('An error occurred. Please try again.', 'error');
          });
      });
    });


    function openOtpModal() {
      document.getElementById('otpModal').classList.remove('hidden');
      // Focus first OTP input
      document.querySelector('#otpModal input').focus();
    }

    document.querySelectorAll('#otpModal input[type="text"]').forEach((el, idx, all) => {
      el.addEventListener('input', () => {
        if (el.value.length === 1 && idx < all.length - 1) {
          all[idx + 1].focus();
        }
      });
    });
    
  </script>
</body>

</html>