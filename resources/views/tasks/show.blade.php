@extends('layout.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-center">
        <div class="w-full max-w-4xl">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="bg-gray-800 text-white px-6 py-4">
                    <h2 class="text-xl font-semibold">Task Details</h2>
                </div>

                <div class="p-6 space-y-6">
                    <!-- Title -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <label class="text-gray-700 font-medium md:text-right md:col-span-1">Title</label>
                        <div class="md:col-span-3">
                            <p class="text-gray-900">{{ $task->title }}</p>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <label class="text-gray-700 font-medium md:text-right md:col-span-1">Description</label>
                        <div class="md:col-span-3">
                            <p class="text-gray-900 whitespace-pre-line">{{ $task->description ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <!-- Project -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <label class="text-gray-700 font-medium md:text-right md:col-span-1">Project</label>
                        <div class="md:col-span-3">
                            <p class="text-gray-900">{{ $task->project->title }}</p>
                        </div>
                    </div>

                    <!-- Assigned By -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <label class="text-gray-700 font-medium md:text-right md:col-span-1">Assigned By</label>
                        <div class="md:col-span-3">
                            <p class="text-gray-900">{{ $task->assigner->name }}</p>
                        </div>
                    </div>

                    <!-- Assigned To -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <label class="text-gray-700 font-medium md:text-right md:col-span-1">Assigned To</label>
                        <div class="md:col-span-3">
                            <p class="text-gray-900">{{ $task->assignee->name }}</p>
                        </div>
                    </div>

                    <!-- Team Members -->
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

                    <!-- Due Date -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <label class="text-gray-700 font-medium md:text-right md:col-span-1">Due Date</label>
                        <div class="md:col-span-3">
                            <p class="text-gray-900">{{ $task->due_date ? $task->due_date->format('M d, Y') : 'N/A' }}</p>
                        </div>
                    </div>
<!-- Status -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-start">
    <label class="text-gray-700 font-medium md:text-right md:col-span-1 pt-2">Status</label>

    <div class="md:col-span-3">
        @if(Auth::id() === $task->assigned_to)
            <!-- ✅ Assigned user can update status -->
            <form action="{{ route('tasks.updateStatus', $task->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <select name="status" onchange="this.form.submit()" 
                        class="px-3 py-2 rounded-md border border-gray-300 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
                    <option value="todo" {{ $task->status == 'todo' ? 'selected' : '' }}>Todo</option>
                    <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="testing" {{ $task->status == 'testing' ? 'selected' : '' }}>Testing</option>
                    <option value="on_hold" {{ $task->status == 'on_hold' ? 'selected' : '' }}>On Hold</option>
                    <option value="cancelled" {{ $task->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </form>
        @else
            <!-- 🔒 Read-only visual badge for others (admin or viewers) -->
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                @if($task->status == 'completed') bg-green-100 text-green-800
                @elseif($task->status == 'in_progress') bg-blue-100 text-blue-800
                @elseif($task->status == 'testing') bg-purple-100 text-purple-800
                @elseif($task->status == 'on_hold') bg-yellow-100 text-yellow-800
                @elseif($task->status == 'cancelled') bg-red-100 text-red-800
                @else bg-gray-100 text-gray-800
                @endif">
                {{ ucfirst(str_replace('_', ' ', $task->status)) }}
            </span>
        @endif
    </div>
</div>



                    <!-- Requirement Document -->
                    @if($task->requirement_document)
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <label class="text-gray-700 font-medium md:text-right md:col-span-1">Requirement Document</label>
                        <div class="md:col-span-3">
                            <a href="{{ Storage::url($task->requirement_document) }}" target="_blank" 
                               class="text-blue-500 hover:underline inline-flex items-center">
                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                                View Document
                            </a>
                        </div>
                    </div>
                    @endif

                    <!-- Images -->
                    @if($task->images && count($task->images) > 0)
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <label class="text-gray-700 font-medium md:text-right md:col-span-1">Images</label>
                        <div class="md:col-span-3">
                            <div class="flex flex-wrap gap-4">
                                @foreach($task->images as $image)
                                <a href="{{ Storage::url($image) }}" target="_blank" class="group relative">
                                    <img src="{{ Storage::url($image) }}" alt="Task image" class="w-32 h-32 object-cover rounded-lg shadow">
                                    <div class="absolute inset-0 bg-black bg-opacity-20 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                                        </svg>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

               <!-- Comments Section -->
<div class="border-t border-gray-200 pt-6">
    <h3 class="text-lg font-medium text-gray-900 mb-4">Comments</h3>
    
    @if($task->comments->count() > 0)
        <div class="space-y-4">
            @foreach($task->comments as $comment)
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="flex justify-between items-start">
                        <div class="flex items-center space-x-2">
                            <span class="font-medium text-gray-900">{{ $comment->user->name }}</span>
                            <span class="text-gray-500 text-sm">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>

                        @if(auth()->id() == $comment->user_id)
                            <div class="flex space-x-2">
                                <!-- Edit Button -->
                                <button type="button" onclick="document.getElementById('edit-form-{{ $comment->id }}').classList.toggle('hidden')" class="text-blue-500 hover:text-blue-700">
                                    ✏️
                                </button>

                                <!-- Delete Form -->
                                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>

                    <!-- Comment Text -->
                    <p class="mt-2 text-gray-700 whitespace-pre-line">{{ $comment->comment }}</p>

                    <!-- Hidden Edit Form -->
                    @if(auth()->id() == $comment->user_id)
                        <form action="{{ route('comments.update', $comment->id) }}" method="POST" class="mt-3 hidden" id="edit-form-{{ $comment->id }}">
                            @csrf
                            @method('PUT')
                            <textarea name="comment" class="w-full p-2 border rounded" rows="2" required>{{ $comment->comment }}</textarea>
                            <button type="submit" class="mt-2 bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                Update
                            </button>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-500">No comments yet.</p>
    @endif

    <!-- Add Comment Form -->
    <form action="{{ route('comments.store') }}" method="POST" class="mt-6">
        @csrf
        <input type="hidden" name="task_id" value="{{ $task->id }}">
        <div class="mb-4">
            <label for="comment" class="block text-sm font-medium text-gray-700 mb-1">Add Comment</label>
            <textarea name="comment" id="comment" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required></textarea>
        </div>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Post Comment
        </button>
    </form>
</div>


                    <!-- Action Buttons -->
                  @php
    $isAdminUser = Auth::id() === $task->assigned_by;
@endphp

@if($isAdminUser)
    <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
        <a href="{{ route('tasks.edit', $task->id) }}" class="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
            Edit Task
        </a>
        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" onclick="return confirm('Are you sure you want to delete this task?')">
                Delete Task
            </button>
        </form>
    </div>
@endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection