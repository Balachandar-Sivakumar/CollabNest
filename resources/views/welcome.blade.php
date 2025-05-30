<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <title>Welcome to CollabPlatform - Collaborative Work Platform</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
  <script defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>

  <!-- AOS animation CSS -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
      body {
    font-family: 'Inter', sans-serif;
  }
  </style>
</head>
<body class="bg-white text-gray-900 flex flex-col">
  <!-- Navbar -->
  <nav class="flex items-center justify-between px-6 py-4 border-b border-gray-200 shadow-sm" data-aos="fade-down">
    <div class="flex items-center space-x-3">
      <div class="w-20 h-20 rounded overflow-hidden">
        <img
          src="assets/logo.png"
          alt="CollabNest Logo"
          class="w-full h-full object-contain"
        />
      </div>
      <h1 class="text-2xl font-bold">
        <span class="text-blue-600">Collab</span><span class="text-blue-600">Nest</span>
      </h1>
    </div>
    <div class="space-x-6 text-sm font-semibold">
      <a href="{{ route('home') }}" class="text-blue-600 transition cursor-pointer">Home</a>
      <a href="{{ route('how-it-works') }}" class="hover:text-blue-600 transition cursor-pointer">How it works</a>
      <a href="{{ route('explore-projects') }}" class="hover:text-blue-600 transition cursor-pointer">Explore Projects</a>
      <a href="{{ route('find-talent') }}" class="hover:text-blue-600 transition cursor-pointer">Find Talent</a>
      <a href="{{ route('help') }}" class="hover:text-blue-600 transition cursor-pointer">Help</a>
    </div>

    <div class="space-x-4">
      <a href="/navlogin" class="text-blue-600 font-semibold hover:underline">Log In</a>
      <a href="/navregister" class="bg-blue-600 text-white px-4 py-2 rounded-md font-semibold hover:bg-blue-700 transition">Sign Up</a>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="flex flex-col-reverse lg:flex-row items-center max-w-7xl mx-auto px-6 gap-12" style="padding:30px 0px">
    <div class="flex-1 max-w-lg" data-aos="fade-right">
      <h2 class="text-4xl font-extrabold leading-tight mb-6">
        Welcome to <span class="text-blue-600">CollabNest</span><br />
        Your Ultimate Collaborative Work Platform
      </h2>
      <p class="text-gray-700 mb-8 text-lg leading-relaxed" data-aos="fade-up" data-aos-delay="200">
        Bridging the gap between skilled individuals and meaningful collaboration.
        Whether you're a developer, designer, freelancer, or entrepreneur, find
        teammates and projects perfectly aligned with your skills, interests, and availability.
      </p>
      <div class="flex space-x-4" data-aos="fade-up" data-aos-delay="400">
        <a href="/register" class="bg-blue-600 text-white px-6 py-3 rounded-md font-semibold hover:bg-blue-700 transition">
          Get Started
        </a>
        <a href="#how-it-works" class="text-blue-600 font-semibold flex items-center hover:underline">
          Learn How It Works
          <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M9 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round"></path>
          </svg>
        </a>
      </div>
    </div>
    <div class="flex-1 max-w-xl" data-aos="fade-left" data-aos-delay="600">
      <img
        src="https://img.freepik.com/free-photo/technology-communication-icons-symbols-concept_53876-124058.jpg?uid=R156815013&ga=GA1.1.1574424695.1745626358&semt=ais_hybrid&w=740"
        alt="Professionals collaborating on projects illustration"
        class="w-full rounded-lg shadow-lg"
        style="height: 460px;"
        width="600"
      />
    </div>
  </section>

  <!-- AOS JS -->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init({
      duration: 800,
      easing: 'ease-in-out',
      once: true,
    });
  </script>
</body>
</html>
