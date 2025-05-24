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
      <div class="w-10 h-10 rounded overflow-hidden">
        <img
          src="https://sdmntprnorthcentralus.oaiusercontent.com/files/00000000-e454-622f-8e2d-e85930ca57ca/raw?se=2025-05-23T23%3A07%3A44Z&sp=r&sv=2024-08-04&sr=b&scid=0347ee2b-e592-56de-8757-bb7ae920edac&skoid=add8ee7d-5fc7-451e-b06e-a82b2276cf62&sktid=a48cca56-e6da-484e-a814-9c849652bcb3&skt=2025-05-23T13%3A08%3A22Z&ske=2025-05-24T13%3A08%3A22Z&sks=b&skv=2024-08-04&sig=ZNSHIzBDzN2Lx2KqIjOpe73Xih6u5VMqAhbofCEpL/I%3D"
          alt="CollabNest Logo"
          class="w-full h-full object-contain"
        />
      </div>
      <h1 class="text-2xl font-bold">
        <span class="text-blue-600">Collab</span><span class="text-blue-600">Nest</span>
      </h1>
    </div>
    <div class="space-x-6 text-sm font-semibold">
      <a href="{{ route('home') }}" class="hover:text-blue-600 transition cursor-pointer">Home</a>
      <a href="{{ route('how-it-works') }}" class="text-blue-600 transition cursor-pointer">How it works</a>
      <a href="{{ route('explore-projects') }}" class="hover:text-blue-600 transition cursor-pointer">Explore Projects</a>
      <a href="{{ route('find-talent') }}" class="hover:text-blue-600 transition cursor-pointer">Find Talent</a>
      <a href="{{ route('help') }}" class="hover:text-blue-600 transition cursor-pointer">Help</a>
    </div>

    <div class="space-x-4">
      <a href="/navlogin" class="text-blue-600 font-semibold hover:underline">Log In</a>
      <a href="/register" class="bg-blue-600 text-white px-4 py-2 rounded-md font-semibold hover:bg-blue-700 transition">Sign Up</a>
    </div>
  </nav>


  <section class="bg-white py-16 px-6">
    <div class="max-w-6xl mx-auto text-center">
      <h2 class="text-4xl font-bold text-blue-600 mb-6" data-aos="fade-up">How CollabNest Works</h2>
      <p class="text-gray-600 text-lg mb-12" data-aos="fade-up" data-aos-delay="100">
        Discover how easy it is to find collaborators, manage tasks, and build amazing projects together.
      </p>

      <div class="grid md:grid-cols-3 gap-10">
        <!-- Step 1 -->
        <div class="p-6 rounded-lg border shadow bg-white" data-aos="zoom-in">
          <img src="https://cdn-icons-png.flaticon.com/512/1055/1055687.png" class="w-20 h-20 mx-auto mb-4" alt="Sign up icon" />
          <h3 class="text-xl font-semibold mb-2">Step 1: Create Profile</h3>
          <p class="text-gray-600">Sign up and build your profile highlighting your skills, interests, and availability.</p>
        </div>

        <!-- Step 2 -->
        <div class="p-6 rounded-lg border shadow bg-white" data-aos="zoom-in" data-aos-delay="200">
          <img src="https://cdn-icons-png.freepik.com/256/8656/8656810.png?uid=R156815013&ga=GA1.1.1574424695.1745626358&semt=ais_incoming" class="w-20 h-20 mx-auto mb-4" alt="Find projects icon" />
          <h3 class="text-xl font-semibold mb-2">Step 2: Discover Projects</h3>
          <p class="text-gray-600">Explore open-source projects, startups, or hackathons that need your skills.</p>
        </div>

        <!-- Step 3 -->
        <div class="p-6 rounded-lg border shadow bg-white" data-aos="zoom-in" data-aos-delay="400">
          <img src="https://cdn-icons-png.freepik.com/256/17017/17017929.png?uid=R156815013&ga=GA1.1.1574424695.1745626358&semt=ais_incoming" class="w-20 h-20 mx-auto mb-4" alt="Collaborate icon" />
          <h3 class="text-xl font-semibold mb-2">Step 3: Start Collaborating</h3>
          <p class="text-gray-600">Join a team, assign tasks, and communicate directly on the platform with real-time tools.</p>
        </div>
      </div>
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
