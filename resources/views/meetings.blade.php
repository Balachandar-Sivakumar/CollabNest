<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>TeamCollab Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet"/>
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body class="bg-[#f8fafc] text-gray-900 min-h-screen flex">

  <!-- Sidebar -->
  @include('layout.aside')

  <!-- Example Jitsi Meet Embed -->
  <div class="w-full h-[600px]">
      <iframe
          src="https://meet.jit.si/{{ $meetingId ?? 'TeamCollabMeeting' }}"
          allow="camera; microphone; fullscreen; display-capture"
          style="width: 100%; height: 100%; border: 0; border-radius: 8px;"
          allowfullscreen
          title="Jitsi Meeting"
      ></iframe>
  </div>

  <div class="p-4">
    <p class="mb-2">Share this link to invite others to your meeting:</p>
    <input type="text" readonly value="{{ $inviteLink }}" class="w-full p-2 border rounded mb-4" onclick="this.select()">

    <div class="mb-4">
        <a href="https://meet.jit.si/{{ $meetingId }}" target="_blank" class="text-blue-600 underline">
            Join Jitsi Meeting
        </a>
    </div>

    @if(isset($meeting) && $meeting->google_meet_link)
        <a href="{{ $meeting->google_meet_link }}" target="_blank" class="text-blue-600 underline">
            Join Google Meet
        </a>
    @else
        <span class="text-gray-500">No Google Meet link available.</span>
    @endif
</div>
  
</body>
</html>
