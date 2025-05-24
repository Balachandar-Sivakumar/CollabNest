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
<body class="bg-white text-gray-900 flex flex-col min-h-screen">
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
      <a href="{{ route('how-it-works') }}" class="hover:text-blue-600 transition cursor-pointer">How it works</a>
      <a href="{{ route('explore-projects') }}" class="text-blue-600 transition cursor-pointer">Explore Projects</a>
      <a href="{{ route('find-talent') }}" class="hover:text-blue-600 transition cursor-pointer">Find Talent</a>
      <a href="{{ route('help') }}" class="hover:text-blue-600 transition cursor-pointer">Help</a>
    </div>
    <div class="space-x-4">
      <a href="/navlogin" class="text-blue-600 font-semibold hover:underline">Log In</a>
      <a href="/register" class="bg-blue-600 text-white px-4 py-2 rounded-md font-semibold hover:bg-blue-700 transition">Sign Up</a>
    </div>
  </nav>

  <!-- Explore Projects Section -->
  <section id="explore-projects" class="max-w-7xl mx-auto px-6 py-12">
    <h2 class="text-3xl font-extrabold mb-8 text-center text-blue-600" data-aos="fade-up">Explore Projects</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
      
      <div class="border rounded-lg shadow hover:shadow-lg transition" data-aos="zoom-in" data-aos-delay="100">
        <img
          src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=800&q=80"
          alt="Open Source Collaboration"
          class="rounded-t-lg object-cover w-full h-48"
        />
        <div class="p-4">
          <h3 class="font-semibold text-lg mb-2">Open Source Collaboration</h3>
          <p class="text-gray-600 text-sm">
            Join a vibrant open-source community and contribute to impactful projects worldwide.
          </p>
        </div>
      </div>

      <div class="border rounded-lg shadow hover:shadow-lg transition" data-aos="zoom-in" data-aos-delay="200">
        <img
          src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?auto=format&fit=crop&w=800&q=80"
          alt="Startup Team Project"
          class="rounded-t-lg object-cover w-full h-48"
        />
        <div class="p-4">
          <h3 class="font-semibold text-lg mb-2">Startup Team Project</h3>
          <p class="text-gray-600 text-sm">
            Collaborate with motivated entrepreneurs to build your next startup idea from scratch.
          </p>
        </div>
      </div>

      <div class="border rounded-lg shadow hover:shadow-lg transition" data-aos="zoom-in" data-aos-delay="300">
        <img
          src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&w=800&q=80"
          alt="Hackathon Challenge"
          class="rounded-t-lg object-cover w-full h-48"
        />
        <div class="p-4">
          <h3 class="font-semibold text-lg mb-2">Hackathon Challenge</h3>
          <p class="text-gray-600 text-sm">
            Join fast-paced hackathons to solve problems with teams across the globe in real time.
          </p>
        </div>
      </div>
      
      <div class="border rounded-lg shadow hover:shadow-lg transition" data-aos="zoom-in" data-aos-delay="400">
        <img
          src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=800&q=80"
          alt="Freelance Projects"
          class="rounded-t-lg object-cover w-full h-48"
        />
        <div class="p-4">
          <h3 class="font-semibold text-lg mb-2">Freelance Projects</h3>
          <p class="text-gray-600 text-sm">
            Find freelance gigs perfectly matched to your skills and work on projects you love.
          </p>
        </div>
      </div>

      <div class="border rounded-lg shadow hover:shadow-lg transition" data-aos="zoom-in" data-aos-delay="500">
        <img
          src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=800&q=80"
          alt="Design Collaboration"
          class="rounded-t-lg object-cover w-full h-48"
        />
        <div class="p-4">
          <h3 class="font-semibold text-lg mb-2">Design Collaboration</h3>
          <p class="text-gray-600 text-sm">
            Work alongside creative designers to bring innovative digital products to life.
          </p>
        </div>
      </div>

      <div class="border rounded-lg shadow hover:shadow-lg transition" data-aos="zoom-in" data-aos-delay="600">
        <img
          src="https://img.freepik.com/free-photo/people-working-html-codes_23-2150038851.jpg?uid=R156815013&ga=GA1.1.1574424695.1745626358&semt=ais_hybrid&w=740"
          alt="Tech Research Groups"
          class="rounded-t-lg object-cover w-full h-48"
        />
        <div class="p-4">
          <h3 class="font-semibold text-lg mb-2">Tech Research Groups</h3>
          <p class="text-gray-600 text-sm">
            Join collaborative research projects to push the boundaries of technology.
          </p>
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
