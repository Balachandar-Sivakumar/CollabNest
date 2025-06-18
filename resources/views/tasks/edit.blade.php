<!-- Add after assigned_to field -->
<div class="mb-4">
    <label for="team" class="block text-gray-700 text-sm font-bold mb-2">
        Team Members
    </label>
    <select name="team[]" id="team" multiple
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        @foreach($project->teamMembers as $member)
            <option value="{{ $member->id }}" 
                {{ in_array($member->id, $task->teamMembers->pluck('id')->toArray()) ? 'selected' : '' }}>
                {{ $member->name }}
            </option>
        @endforeach
    </select>
</div>

<!-- Status Options -->
<div class="mb-6">
    <label for="status" class="block text-gray-700 text-sm font-bold mb-2">
        Status
    </label>
    <select id="status" 
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
            name="status" required>
        <option value="todo" {{ $task->status == 'todo' ? 'selected' : '' }}>TODO</option>
        <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
        <option value="testing" {{ $task->status == 'testing' ? 'selected' : '' }}>Testing</option>
        <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
        <option value="on_hold" {{ $task->status == 'on_hold' ? 'selected' : '' }}>On Hold</option>
        <option value="cancelled" {{ $task->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
    </select>
</div>

<!-- File Uploads -->
<div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2">
        Requirement Document
    </label>
    @if($task->requirement_document)
        <p class="mb-2">
            <a href="{{ Storage::url($task->requirement_document) }}" 
               target="_blank" class="text-blue-500 hover:underline">
                Current Document
            </a>
        </p>
    @endif
    <input type="file" name="requirement_document">
</div>

<div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2">
        Images
    </label>
    @if($task->images)
        <div class="flex flex-wrap gap-2 mb-4">
            @foreach($task->images as $image)
                <img src="{{ Storage::url($image) }}" alt="Task image" class="w-16 h-16 object-cover">
            @endforeach
        </div>
    @endif
    <input type="file" name="images[]" multiple>
</div>