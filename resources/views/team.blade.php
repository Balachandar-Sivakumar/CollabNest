<!-- Check if user owns any project -->
@if($allProjects->where('owner_id', Auth::id())->count())
<div x-data="{ showModal: false }" class="mb-6">
  <!-- Create Team Button -->
  <button
    @click="showModal = true"
    class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-xl shadow hover:bg-blue-700 transition">
    + Create Team
  </button>

  <!-- Modal Overlay -->
  <div
    x-show="showModal"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
    x-transition
    x-cloak>
    <!-- Modal Content -->
    <div @click.away="showModal = false" class="bg-white p-6 rounded-xl shadow-xl w-full max-w-lg">
      <h2 class="text-xl font-semibold text-gray-800 mb-4">Create New Team</h2>
      <form action="{{ route('teams.store') }}" method="POST">
        @csrf
        <!-- Team Name -->
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Team Name</label>
          <input type="text" name="team_name" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-400" />
        </div>
        <!-- Select Project -->
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Select Project</label>
          <select name="project_id" required class="w-full px-4 py-2 border border-gray-300 rounded-md">
            @foreach($allProjects->where('owner_id', Auth::id()) as $proj)
            <option value="{{ $proj->id }}">{{ $proj->title }}</option>
            @endforeach
          </select>
        </div>
        <!-- Description -->
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
          <textarea name="description" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-md resize-none"></textarea>
        </div>
        <!-- Members -->
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Select Members</label>
          <select name="members[]" multiple class="w-full px-4 py-2 border border-gray-300 rounded-md">
            @foreach($projectMembers as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
          </select>
          <p class="text-xs text-gray-500 mt-1">Hold Ctrl (Cmd) to select multiple.</p>
        </div>
        <!-- Actions -->
        <div class="flex justify-end space-x-2 mt-6">
          <button type="button" @click="showModal = false" class="px-4 py-2 text-sm bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
          <button type="submit" class="px-4 py-2 text-sm bg-blue-600 text-white rounded hover:bg-blue-700">Create</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endif

<!-- Teams List -->
<div class="bg-white shadow-md rounded-2xl p-6 space-y-4">
  <h2 class="text-xl font-semibold mb-4 text-gray-800">All Teams</h2>
  @forelse($teams as $team)
    <div class="flex flex-col md:flex-row md:items-center md:justify-between border-b border-gray-200 p-4 rounded-xl hover:shadow transition">
      <!-- Left: Team Info -->
      <div class="mb-2 md:mb-0">
        <div class="font-semibold text-indigo-700 text-lg flex items-center">
          <i class="fas fa-users mr-2"></i> {{ $team->name ?? $team->team_name }}
        </div>
        <div class="text-gray-600"><strong>Project:</strong> {{ $team->project->title ?? '-' }}</div>
        <div class="text-gray-600"><strong>Description:</strong> {{ $team->description ?? 'No description provided' }}</div>
        <div class="text-gray-600 mt-1"><strong>Members:</strong>
          @forelse($team->members as $member)
            <span class="inline-block bg-gray-100 px-2 py-0.5 rounded text-sm mr-1 mb-1">
              {{ $member->user->name ?? 'Unknown' }}
            </span>
          @empty
            <span class="text-gray-400 text-xs">No members</span>
          @endforelse
        </div>
      </div>
      <!-- Right: Actions -->
      <div class="flex items-center space-x-2 mt-2 md:mt-0">
        @if(Auth::id() === optional($team->project)->owner_id)
          <a href="{{ route('team.edit', $team->id) }}"
            class="px-3 py-1 bg-yellow-500 text-white text-sm rounded hover:bg-yellow-600 flex items-center">
            <i class="fas fa-edit mr-1"></i> Edit
          </a>
          <form action="{{ route('team.destroy', $team->id) }}" method="POST"
            onsubmit="return confirm('Are you sure you want to delete this team?');" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit"
              class="px-3 py-1 bg-red-500 text-white text-sm rounded hover:bg-red-600 flex items-center">
              <i class="fas fa-trash mr-1"></i> Delete
            </button>
          </form>
        @else
          <span class="px-3 py-1 bg-gray-200 text-gray-600 text-sm rounded flex items-center">
            <i class="fas fa-eye mr-1"></i> View Only
          </span>
        @endif
      </div>
    </div>
  @empty
    <p class="text-gray-500 text-center">No teams created yet.</p>
  @endforelse
</div>