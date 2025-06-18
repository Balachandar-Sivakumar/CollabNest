<!-- Add after description field -->
<div class="mb-4">
    <label for="requirement_document" class="block text-gray-700 text-sm font-bold mb-2">
        Requirement Document
    </label>
    <input type="file" name="requirement_document" id="requirement_document"
           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
</div>

<!-- Team Members -->
<div class="mb-4">
    <label for="team" class="block text-gray-700 text-sm font-bold mb-2">
        Team Members
    </label>
    <select name="team[]" id="team" multiple
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        @foreach($project->teamMembers as $member)
            <option value="{{ $member->id }}">{{ $member->name }}</option>
        @endforeach
    </select>
</div>

<!-- Images -->
<div class="mb-4">
    <label for="images" class="block text-gray-700 text-sm font-bold mb-2">
        Upload Images
    </label>
    <input type="file" name="images[]" id="images" multiple
           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
</div>

<!-- Status Options -->
<div class="mb-6">
    <label for="status" class="block text-gray-700 text-sm font-bold mb-2">
        Status
    </label>
    <select id="status" 
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
            name="status" required>
        <option value="todo" {{ old('status') == 'todo' ? 'selected' : '' }}>TODO</option>
        <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
        <option value="testing" {{ old('status') == 'testing' ? 'selected' : '' }}>Testing</option>
        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
        <option value="on_hold" {{ old('status') == 'on_hold' ? 'selected' : '' }}>On Hold</option>
        <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
    </select>
</div>