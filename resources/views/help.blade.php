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
<body class="bg-gray-50 text-gray-800 min-h-screen flex">

    @include('layout.aside')
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
