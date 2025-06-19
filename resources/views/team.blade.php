@section('content')
<div class="container mx-auto px-4 py-6">
  <h2 class="text-2xl font-semibold mb-4">Project Teams</h2>

  {{-- Team Creation Modal Trigger --}}
  <button onclick="document.getElementById('createTeamModal').classList.remove('hidden')"
    class="bg-blue-600 text-white px-4 py-2 rounded mb-4 hover:bg-blue-700">
    ➕ Create New Team
  </button>

  {{-- Team List --}}
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($teams as $team)
    <div class="bg-white p-4 rounded shadow">
      <h3 class="text-xl font-bold">{{ $team->name }}</h3>
      <p class="text-gray-600">{{ $team->description }}</p>
      <p class="mt-2 text-sm text-gray-500">Project: {{ $team->project->title }}</p>

      <p class="mt-1 text-sm text-gray-500 font-medium">Team Lead:
        {{ $team->teamLead->name ?? 'N/A' }}
      </p>

      {{-- Members --}}
      <div class="mt-2">
        <h4 class="font-semibold text-sm mb-1">Team Members:</h4>
        <ul class="list-disc list-inside text-sm">
          @foreach($team->members as $member)
          <li>{{ $member->user->name }}</li>
          @endforeach
        </ul>
      </div>

      {{-- Actions if current user is project owner --}}
      @if($team->team_lead_id == Auth::id())
      <div class="mt-4 flex space-x-2">
        <a href="{{ route('teams.edit', $team->id) }}"
          class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500">
          ✏️ Edit
        </a>
        <form action="{{ route('teams.delete', $team->id) }}" method="POST"
          onsubmit="return confirm('Are you sure you want to delete this team?');">
          @csrf
          @method('DELETE')
          <button type="submit"
            class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
            🗑️ Delete
          </button>
        </form>
      </div>
      @endif
    </div>
    @endforeach
  </div>
</div>

{{-- Modal for Creating Team --}}
<div id="createTeamModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
  <div class="bg-white w-full max-w-lg p-6 rounded-lg">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-lg font-semibold">Create New Team</h2>
      <button onclick="document.getElementById('createTeamModal').classList.add('hidden')"
        class="text-red-500 text-xl">&times;</button>
    </div>

    <form action="{{ route('teams.store') }}" method="POST">
      @csrf
      <div class="mb-4">
        <label class="block text-sm font-semibold mb-1">Team Name:</label>
        <input type="text" name="team_name" required
          class="w-full px-3 py-2 border border-gray-300 rounded-md" />
      </div>

      <div class="mb-4">
        <label class="block text-sm font-semibold mb-1">Description:</label>
        <textarea name="description" rows="3"
          class="w-full px-3 py-2 border border-gray-300 rounded-md"></textarea>
      </div>

      <div class="mb-4">
        <label class="block text-sm font-semibold mb-1">Select Team Members:</label>
        <select name="members[]" multiple required
          class="w-full px-3 py-2 border border-gray-300 rounded-md bg-white h-40">
          @foreach($projectMembers as $member)
          <option value="{{ $member->id }}">{{ $member->name }}</option>
          @endforeach
        </select>
        <p class="text-xs text-gray-500 mt-1">Hold Ctrl (or Cmd) to select multiple members.</p>
      </div>

      <div class="flex justify-end">
        <button type="submit"
          class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
          ✅ Create
        </button>
      </div>
    </form>
  </div>
</div>