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
  <nav class="flex items-center justify-between px-6 py-4 border-b border-gray-200 shadow-sm" data-aos="fade-down" data-aos-duration="1000">
    <div class="flex items-center space-x-3">
      <div class="w-10 h-10 rounded overflow-hidden" data-aos="zoom-in" data-aos-delay="200" data-aos-duration="800">
        <img
          src="https://sdmntprnorthcentralus.oaiusercontent.com/files/00000000-e454-622f-8e2d-e85930ca57ca/raw?se=2025-05-23T23%3A07%3A44Z&sp=r&sv=2024-08-04&sr=b&scid=0347ee2b-e592-56de-8757-bb7ae920edac&skoid=add8ee7d-5fc7-451e-b06e-a82b2276cf62&sktid=a48cca56-e6da-484e-a814-9c849652bcb3&skt=2025-05-23T13%3A08%3A22Z&ske=2025-05-24T13%3A08%3A22Z&sks=b&skv=2024-08-04&sig=ZNSHIzBDzN2Lx2KqIjOpe73Xih6u5VMqAhbofCEpL/I%3D"
          alt="CollabNest Logo"
          class="w-full h-full object-contain"
        />
      </div>
      <h1 class="text-2xl font-bold" data-aos="fade-right" data-aos-delay="400" data-aos-duration="1000">
        <span class="text-blue-600">Collab</span><span class="text-blue-600">Nest</span>
      </h1>
    </div>
    <div class="space-x-6 text-sm font-semibold" data-aos="fade-left" data-aos-delay="600" data-aos-duration="1000">
      <a href="{{ route('home') }}" class="hover:text-blue-600 transition cursor-pointer">Home</a>
      <a href="{{ route('how-it-works') }}" class="hover:text-blue-600 transition cursor-pointer">How it works</a>
      <a href="{{ route('explore-projects') }}" class="hover:text-blue-600 transition cursor-pointer">Explore Projects</a>
      <a href="{{ route('find-talent') }}" class="hover:text-blue-600 transition cursor-pointer">Find Talent</a>
      <a href="{{ route('help') }}" class="text-blue-600 transition cursor-pointer">Help</a>
    </div>

    <div class="space-x-4" data-aos="fade-left" data-aos-delay="800" data-aos-duration="1000">
      <a href="/navlogin" class="text-blue-600 font-semibold hover:underline">Log In</a>
      <a href="/register" class="bg-blue-600 text-white px-4 py-2 rounded-md font-semibold hover:bg-blue-700 transition">Sign Up</a>
    </div>
  </nav>

  <!-- Main Content: iframe + contact form -->
  <main class="flex-grow max-w-7xl mx-auto w-full grid grid-cols-1 md:grid-cols-2 gap-10 p-6">
    <!-- Left: Iframe with DCKAP Palli location -->
    <div
      class="w-full h-96 md:h-auto rounded-lg overflow-hidden shadow-lg"
      data-aos="fade-right"
      data-aos-duration="1000"
      data-aos-delay="400"
    >
    <iframe
  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3907.504277365651!2d80.2232661152601!3d13.08971510281212!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a52642e3c8faf7f%3A0x5c1f7526b2bfe819!2sDCKAP!5e0!3m2!1sen!2sin!4v1684983388236!5m2!1sen!2sin"
  width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
  title="DCKAP Location">
</iframe>
    </div>

    <!-- Right: Contact form -->
    <form
      class="bg-white p-8 rounded-lg shadow-lg"
      action="#"
      method="POST"
      data-aos="fade-left"
      data-aos-duration="1000"
      data-aos-delay="600"
    >
      <h2 class="text-2xl font-semibold mb-6 text-blue-600">Contact Us</h2>
      <div class="mb-4">
        <label for="name" class="block text-gray-700 font-medium mb-2">Your Name</label>
        <input
          type="text"
          id="name"
          name="name"
          required
          class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
          placeholder="Enter your name"
        />
      </div>
      <div class="mb-4">
        <label for="email" class="block text-gray-700 font-medium mb-2">Email ID</label>
        <input
          type="email"
          id="email"
          name="email"
          required
          class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
          placeholder="Enter your email"
        />
      </div>
      <div class="mb-4">
        <label for="message" class="block text-gray-700 font-medium mb-2">Message</label>
        <textarea
          id="message"
          name="message"
          rows="4"
          required
          class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
          placeholder="Write your message"
        ></textarea>
      </div>
      <button
        type="submit"
        class="w-full bg-blue-600 text-white py-2 rounded-md font-semibold hover:bg-blue-700 transition"
      >
        Send Message
      </button>
    </form>
  </main>

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
