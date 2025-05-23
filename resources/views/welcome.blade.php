<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   Welcome to CollabPlatform
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&amp;display=swap" rel="stylesheet"/>
  <style>
   body {
      font-family: 'Inter', sans-serif;
    }
  </style>
 </head>
 <body class="bg-white text-gray-900 min-h-screen flex flex-col">
  <!-- Navbar -->
  <nav class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
   <div class="flex items-center space-x-3">
    <div class="bg-blue-600 text-white p-3 rounded-md text-2xl">
     <i class="fas fa-th-large">
     </i>
    </div>
    <h1 class="text-2xl font-bold">
     <span class="text-blue-600">
      Collab
     </span>
     Platform
    </h1>
   </div>
   <div class="space-x-6 text-sm font-semibold">
    <a class="hover:text-blue-600 transition" href="#">
     How it works
    </a>
    <a class="hover:text-blue-600 transition" href="#">
     Explore Projects
    </a>
    <a class="hover:text-blue-600 transition" href="#">
     Find Talent
    </a>
    <a class="hover:text-blue-600 transition" href="#">
     Pricing
    </a>
    <a class="hover:text-blue-600 transition" href="#">
     Help
    </a>
   </div>
   <div class="space-x-4">
    <a class="text-blue-600 font-semibold hover:underline" href="/navlogin">
     Log In
    </a>
    <a class="bg-blue-600 text-white px-4 py-2 rounded-md font-semibold hover:bg-blue-700 transition" href="/register">
     Sign Up
    </a>
   </div>
  </nav>
  <!-- Hero Section -->
  <section class="flex flex-col-reverse lg:flex-row items-center max-w-7xl mx-auto px-6 py-20 gap-12">
   <div class="flex-1 max-w-lg">
    <h2 class="text-4xl font-extrabold leading-tight mb-6">
     Find the perfect
     <span class="text-blue-600">
      freelance talent
     </span>
     or
     <br/>
     <span class="text-blue-600">
      collaborate on projects
     </span>
     with ease.
    </h2>
    <p class="text-gray-700 mb-8 text-lg">
     Join thousands of professionals and businesses using CollabPlatform to connect, create, and grow. Whether you’re looking to hire or get hired, we make collaboration simple and efficient.
    </p>
    <div class="flex space-x-4">
     <a class="bg-blue-600 text-white px-6 py-3 rounded-md font-semibold hover:bg-blue-700 transition" href="/register">
      Get Started
     </a>
     <a class="text-blue-600 font-semibold flex items-center hover:underline" href="#how-it-works">
      Learn How It Works
      <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
       <path d="M9 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round">
       </path>
      </svg>
     </a>
    </div>
   </div>
   <div class="flex-1 max-w-xl">
    <img alt="Illustration showing diverse professionals collaborating on projects" class="w-full rounded-lg shadow-lg" height="400" src="https://storage.googleapis.com/a1aa/image/309aa98f-d76f-48a7-8624-995ddedf7a27.jpg" width="600"/>
   </div>
  </section>
  <!-- How It Works -->
  <section class="bg-gray-50 py-20 px-6" id="how-it-works">
   <div class="max-w-7xl mx-auto text-center mb-16">
    <h3 class="text-3xl font-bold mb-4">
     How It Works
    </h3>
    <p class="text-gray-700 max-w-2xl mx-auto text-lg">
     Whether you’re a freelancer or a business, CollabPlatform makes it easy to find the right match and get work done efficiently.
    </p>
   </div>
   <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-12">
    <div class="bg-white p-8 rounded-lg shadow-md">
     <div class="bg-blue-600 text-white w-12 h-12 flex items-center justify-center rounded-full mb-4 text-xl font-bold">
      1
     </div>
     <h4 class="font-semibold text-xl mb-2">
      Create Your Profile
     </h4>
     <p class="text-gray-600">
      Showcase your skills, experience, and interests to attract the right projects or talent.
     </p>
    </div>
    <div class="bg-white p-8 rounded-lg shadow-md">
     <div class="bg-blue-600 text-white w-12 h-12 flex items-center justify-center rounded-full mb-4 text-xl font-bold">
      2
     </div>
     <h4 class="font-semibold text-xl mb-2">
      Find Projects or Talent
     </h4>
     <p class="text-gray-600">
      Browse projects or freelancers that match your skills and needs, and connect instantly.
     </p>
    </div>
    <div class="bg-white p-8 rounded-lg shadow-md">
     <div class="bg-blue-600 text-white w-12 h-12 flex items-center justify-center rounded-full mb-4 text-xl font-bold">
      3
     </div>
     <h4 class="font-semibold text-xl mb-2">
      Collaborate &amp; Get Paid
     </h4>
     <p class="text-gray-600">
      Use our tools for communication, file sharing, and project management to complete work smoothly.
     </p>
    </div>
   </div>
  </section>
  <!-- Popular Categories -->
  <section class="max-w-7xl mx-auto px-6 py-20">
   <h3 class="text-3xl font-bold mb-10 text-center">
    Popular Categories
   </h3>
   <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-6 text-center">
    <a class="bg-gray-100 hover:bg-blue-50 rounded-lg p-6 transition flex flex-col items-center space-y-3" href="#">
     <div class="bg-blue-600 text-white p-3 rounded-full text-2xl">
      <i class="fas fa-code">
      </i>
     </div>
     <span class="font-semibold text-gray-800">
      Web Development
     </span>
    </a>
    <a class="bg-gray-100 hover:bg-blue-50 rounded-lg p-6 transition flex flex-col items-center space-y-3" href="#">
     <div class="bg-blue-600 text-white p-3 rounded-full text-2xl">
      <i class="fas fa-paint-brush">
      </i>
     </div>
     <span class="font-semibold text-gray-800">
      Design &amp; Creative
     </span>
    </a>
    <a class="bg-gray-100 hover:bg-blue-50 rounded-lg p-6 transition flex flex-col items-center space-y-3" href="#">
     <div class="bg-blue-600 text-white p-3 rounded-full text-2xl">
      <i class="fas fa-chart-line">
      </i>
     </div>
     <span class="font-semibold text-gray-800">
      Marketing
     </span>
    </a>
    <a class="bg-gray-100 hover:bg-blue-50 rounded-lg p-6 transition flex flex-col items-center space-y-3" href="#">
     <div class="bg-blue-600 text-white p-3 rounded-full text-2xl">
      <i class="fas fa-pen-nib">
      </i>
     </div>
     <span class="font-semibold text-gray-800">
      Writing
     </span>
    </a>
    <a class="bg-gray-100 hover:bg-blue-50 rounded-lg p-6 transition flex flex-col items-center space-y-3" href="#">
     <div class="bg-blue-600 text-white p-3 rounded-full text-2xl">
      <i class="fas fa-video">
      </i>
     </div>
     <span class="font-semibold text-gray-800">
      Video &amp; Animation
     </span>
    </a>
    <a class="bg-gray-100 hover:bg-blue-50 rounded-lg p-6 transition flex flex-col items-center space-y-3" href="#">
     <div class="bg-blue-600 text-white p-3 rounded-full text-2xl">
      <i class="fas fa-headset">
      </i>
     </div>
     <span class="font-semibold text-gray-800">
      Customer Support
     </span>
    </a>
   </div>
  </section>
  <!-- Footer -->
  <footer class="bg-gray-100 py-10 mt-auto">
   <div class="max-w-7xl mx-auto px-6 text-center text-gray-600 text-sm">
    © 2024 CollabPlatform. All rights reserved.
   </div>
  </footer>
  <script defer="" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js">
  </script>
 </body>
</html>