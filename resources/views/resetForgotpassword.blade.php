<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Change Password</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <style>
    .password-bullet {
      transition: all 0.3s ease;
    }
    .password-valid {
      color: #10B981;
    }
    .password-valid .password-bullet {
      background-color: #10B981;
    }
  </style>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen p-4">

  <div class="bg-white p-8 rounded-xl shadow-sm w-full max-w-md border border-gray-200">
    <div class="text-center mb-8">
      <div class="mx-auto w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
        </svg>
      </div>
      <h2 class="text-2xl font-bold text-gray-800">Change Your Password</h2>
      <p class="text-gray-500 mt-2 text-sm">Please create a new secure password</p>
    </div>

    <!-- Laravel Error/Success -->
    @if(session('status'))
    <div class="bg-green-50 text-green-700 p-3 rounded-lg mb-6 text-sm border border-green-100 flex items-start">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-0.5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
      </svg>
      <div>{{ session('status') }}</div>
    </div>
    @endif

    @if($errors->any())
    <div class="bg-red-50 text-red-700 p-3 rounded-lg mb-6 text-sm border border-red-100">
      <div class="flex items-start">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-0.5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
        </svg>
        <div>
          <h4 class="font-medium">Please fix these issues:</h4>
          <ul class="list-disc list-inside mt-1 pl-4">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
    @endif

    <!-- JS Validation Error Box -->
    <div id="passwordError" class="hidden bg-red-50 text-red-700 p-3 rounded-lg mb-6 text-sm border border-red-100">
      <div class="flex items-start">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-0.5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
        </svg>
        <div id="errorContent"></div>
      </div>
    </div>

    <form method="POST" action="/changePassword" id="resetForm" class="space-y-5">
      @csrf

      <!-- Hidden token field -->
      <input type="hidden" name="token" value="{{ $token ?? '' }}">

      <div class="bg-gray-50 p-3 rounded-lg border border-gray-200">
        <div class="flex items-center space-x-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
          </svg>
          <span class="text-gray-700">{{ \App\Models\User::where('email', $email)->value('name') }}</span>
        </div>
      </div>

      <div class="hidden">
        <input type="email" id="email" name="email" value="{{ $email ?? '' }}" autocomplete="email">
      </div>

      <div>
        <label for="new_password" class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
        <div class="relative">
          <input type="password" id="new_password" name="password" autocomplete="new-password"
            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 focus:outline-none transition placeholder-gray-400"
            placeholder="Enter new password">
          <div class="absolute inset-y-0 right-0 flex items-center pr-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
            </svg>
          </div>
        </div>
        <div class="mt-3 text-xs text-gray-500 space-y-1.5">
          <p class="flex items-center password-requirement" data-rule="length"><span class="password-bullet inline-block w-2 h-2 rounded-full bg-gray-300 mr-2"></span> At least 8 characters</p>
          <p class="flex items-center password-requirement" data-rule="uppercase"><span class="password-bullet inline-block w-2 h-2 rounded-full bg-gray-300 mr-2"></span> One uppercase letter</p>
          <p class="flex items-center password-requirement" data-rule="lowercase"><span class="password-bullet inline-block w-2 h-2 rounded-full bg-gray-300 mr-2"></span> One lowercase letter</p>
          <p class="flex items-center password-requirement" data-rule="number"><span class="password-bullet inline-block w-2 h-2 rounded-full bg-gray-300 mr-2"></span> One number</p>
          <p class="flex items-center password-requirement" data-rule="special"><span class="password-bullet inline-block w-2 h-2 rounded-full bg-gray-300 mr-2"></span> One special character</p>
        </div>
      </div>

      <div>
        <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
        <div class="relative">
          <input type="password" id="confirm_password" name="password_confirmation" autocomplete="new-password"
            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 focus:outline-none transition placeholder-gray-400"
            placeholder="Confirm your password">
          <div class="absolute inset-y-0 right-0 flex items-center pr-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
            </svg>
          </div>
        </div>
      </div>

      <button type="submit"
        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-4 rounded-lg transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 shadow-sm">
        Update Password
      </button>
    </form>

    <div class="mt-6 text-center text-sm">
      <a href="/navlogin" class="text-blue-600 hover:text-blue-700 font-medium inline-flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Back to login
      </a>
    </div>
  </div>

  <!-- Enhanced JS Validation -->
  <script>
    document.getElementById('resetForm').addEventListener('submit', function(e) {
      const email = document.getElementById('email').value.trim();
      const pass1 = document.getElementById('new_password').value;
      const pass2 = document.getElementById('confirm_password').value;
      const errorBox = document.getElementById('passwordError');
      const errorContent = document.getElementById('errorContent');
      
      // Clear previous errors
      errorBox.classList.add('hidden');
      errorContent.innerHTML = '';

      // Validation checks
      const errors = [];

      // Email validation
      if (!email) {
        errors.push('Email is required');
      } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        errors.push('Please enter a valid email address');
      }

      // Password validation
      if (!pass1) {
        errors.push('Password is required');
      } else {
        if (pass1.length < 8) {
          errors.push('Password must be at least 8 characters long');
        }
        if (!/[A-Z]/.test(pass1)) {
          errors.push('Password must contain at least one uppercase letter');
        }
        if (!/[a-z]/.test(pass1)) {
          errors.push('Password must contain at least one lowercase letter');
        }
        if (!/[0-9]/.test(pass1)) {
          errors.push('Password must contain at least one number');
        }
        if (!/[^A-Za-z0-9]/.test(pass1)) {
          errors.push('Password must contain at least one special character');
        }
      }

      // Password confirmation
      if (pass1 && pass1 !== pass2) {
        errors.push('Passwords do not match');
      }

      // Display errors if any
      if (errors.length > 0) {
        e.preventDefault();
        errorContent.innerHTML = `
          <h4 class="font-medium">Please fix these issues:</h4>
          <ul class="list-disc list-inside mt-1 pl-4">
            ${errors.map(error => `<li>${error}</li>`).join('')}
          </ul>
        `;
        errorBox.classList.remove('hidden');

        // Scroll to error message
        errorBox.scrollIntoView({
          behavior: 'smooth',
          block: 'nearest'
        });
      }
    });

    // Real-time password matching indicator
    document.getElementById('confirm_password').addEventListener('input', function() {
      const pass1 = document.getElementById('new_password').value;
      const pass2 = this.value;
      const errorBox = document.getElementById('passwordError');

      if (pass1 && pass2 && pass1 !== pass2) {
        errorBox.querySelector('#errorContent').innerHTML = 'Passwords do not match';
        errorBox.classList.remove('hidden');
      } else if (errorBox.querySelector('#errorContent').textContent === 'Passwords do not match') {
        errorBox.classList.add('hidden');
      }
    });

    // Real-time password requirement validation
    document.getElementById('new_password').addEventListener('input', function() {
      const password = this.value;
      const requirements = {
        length: password.length >= 8,
        uppercase: /[A-Z]/.test(password),
        lowercase: /[a-z]/.test(password),
        number: /[0-9]/.test(password),
        special: /[^A-Za-z0-9]/.test(password)
      };

      document.querySelectorAll('.password-requirement').forEach(item => {
        const rule = item.getAttribute('data-rule');
        if (requirements[rule]) {
          item.classList.add('password-valid');
        } else {
          item.classList.remove('password-valid');
        }
      });
    });
  </script>

</body>
</html>