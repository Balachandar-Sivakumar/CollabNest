<!-- Add after status display -->
@if($task->requirement_document)
<div class="grid grid-cols-1 md:grid-cols-4 gap-4">
    <label class="text-gray-700 font-medium md:text-right md:col-span-1">Requirement Document</label>
    <div class="md:col-span-3">
        <a href="{{ Storage::url($task->requirement_document) }}" target="_blank" 
           class="text-blue-500 hover:underline">
            View Document
        </a>
    </div>
</div>
@endif

@if($task->images)
<div class="grid grid-cols-1 md:grid-cols-4 gap-4">
    <label class="text-gray-700 font-medium md:text-right md:col-span-1">Images</label>
    <div class="md:col-span-3 flex flex-wrap gap-2">
        @foreach($task->images as $image)
        <a href="{{ Storage::url($image) }}" target="_blank">
            <img src="{{ Storage::url($image) }}" alt="Task image" class="w-24 h-24 object-cover rounded">
        </a>
        @endforeach
    </div>
</div>
@endif

@if($task->teamMembers->count())
<div class="grid grid-cols-1 md:grid-cols-4 gap-4">
    <label class="text-gray-700 font-medium md:text-right md:col-span-1">Team Members</label>
    <div class="md:col-span-3">
        <div class="flex flex-wrap gap-2">
            @foreach($task->teamMembers as $member)
            <span class="bg-gray-200 px-3 py-1 rounded-full text-sm">
                {{ $member->name }}
            </span>
            @endforeach
        </div>
    </div>
</div>
@endif

<!-- Comments Section -->
<div class="mt-8">
    <h3 class="text-lg font-semibold mb-4">Comments</h3>
    
    <!-- Comment Form -->
    <form method="POST" action="{{ route('taskcomments.store', $task) }}" class="mb-6">
        @csrf
        <div class="flex gap-2">
            <textarea name="comment" rows="2" 
                      class="flex-1 border rounded p-2" 
                      placeholder="Add a comment..."></textarea>
            <button type="submit" 
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Post
            </button>
        </div>
    </form>

    <!-- Comments List -->
    <div class="space-y-4">
        @foreach($comments as $comment)
        <div class="border rounded p-4">
            <div class="flex justify-between items-start">
                <div>
                    <h4 class="font-semibold">{{ $comment->user->name }}</h4>
                    <p class="text-gray-500 text-sm">{{ $comment->created_at->diffForHumans() }}</p>
                </div>
                @can('update', $comment)
                <div class="flex gap-2">
                    <a href="#" 
                       data-id="{{ $comment->id }}"
                       data-comment="{{ $comment->comment }}"
                       class="edit-comment text-blue-500 hover:text-blue-700">
                        Edit
                    </a>
                    <form method="POST" 
                          action="{{ route('taskcomments.destroy', $comment) }}">
                        @csrf @method('DELETE')
                        <button type="submit" 
                                class="text-red-500 hover:text-red-700"
                                onclick="return confirm('Delete this comment?')">
                            Delete
                        </button>
                    </form>
                </div>
                @endcan
            </div>
            <p class="mt-2 comment-content">{{ $comment->comment }}</p>
        </div>
        @endforeach
    </div>
</div>

<!-- Edit Comment Modal -->
<div id="editCommentModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-lg p-6 w-96">
        <h3 class="text-xl font-semibold mb-4">Edit Comment</h3>
        <form id="editCommentForm" method="POST">
            @csrf @method('PUT')
            <textarea name="comment" rows="3" class="w-full border rounded p-2 mb-4"></textarea>
            <div class="flex justify-end gap-2">
                <button type="button" id="cancelEdit" 
                        class="bg-gray-500 text-white px-4 py-2 rounded">
                    Cancel
                </button>
                <button type="submit" 
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.querySelectorAll('.edit-comment').forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            const form = document.getElementById('editCommentForm');
            const modal = document.getElementById('editCommentModal');
            const commentId = button.dataset.id;
            const commentContent = button.dataset.comment;
            
            form.action = `/comments/${commentId}`;
            form.querySelector('textarea').value = commentContent;
            modal.classList.remove('hidden');
        });
    });

    document.getElementById('cancelEdit').addEventListener('click', () => {
        document.getElementById('editCommentModal').classList.add('hidden');
    });
</script>