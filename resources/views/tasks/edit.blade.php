@extends('layout.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-center">
        <div class="w-full max-w-2xl">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="bg-gray-800 text-white px-6 py-4">
                    <h2 class="text-xl font-semibold">Edit Task</h2>
                </div>

                <div class="p-6">
                    <form method="POST" action="{{ route('tasks.update', $task) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div class="mb-4">
                            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">
                                Title <span class="text-red-500">*</span>
                            </label>
                            <input id="title" type="text" 
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('title') border-red-500 @enderror" 
                                   name="title" value="{{ old('title', $task->title) }}" required>
                            @error('title')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">
                                Description
                            </label>
                            <textarea id="description" rows="3"
                                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('description') border-red-500 @enderror" 
                                      name="description">{{ old('description', $task->description) }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Assign To -->
                        <div class="mb-4">
                            <label for="assigned_to" class="block text-gray-700 text-sm font-bold mb-2">
                                Assign To <span class="text-red-500">*</span>
                            </label>
                            <select id="assigned_to" 
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('assigned_to') border-red-500 @enderror" 
                                    name="assigned_to" required>
                                <option value="">Select User</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('assigned_to', $task->assigned_to) == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('assigned_to')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Due Date -->
                        <div class="mb-4">
                            <label for="due_date" class="block text-gray-700 text-sm font-bold mb-2">
                                Due Date
                            </label>
                            <input id="due_date" type="date" 
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('due_date') border-red-500 @enderror" 
                                   name="due_date" value="{{ old('due_date', $task->due_date ? $task->due_date->format('Y-m-d') : '') }}">
                            @error('due_date')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <label for="status" class="block text-gray-700 text-sm font-bold mb-2">
                                Status <span class="text-red-500">*</span>
                            </label>
                            <select id="status" 
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('status') border-red-500 @enderror" 
                                    name="status" required>
                                <option value="todo" {{ old('status', $task->status) == 'todo' ? 'selected' : '' }}>TODO</option>
                                <option value="in_progress" {{ old('status', $task->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="testing" {{ old('status', $task->status) == 'testing' ? 'selected' : '' }}>Testing</option>
                                <option value="completed" {{ old('status', $task->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="on_hold" {{ old('status', $task->status) == 'on_hold' ? 'selected' : '' }}>On Hold</option>
                                <option value="cancelled" {{ old('status', $task->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            @error('status')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Requirement Document -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Requirement Document
                            </label>
                            @if($task->requirement_document)
                                <p class="mb-2">
                                    <a href="{{ Storage::url($task->requirement_document) }}" target="_blank" class="text-blue-500 hover:underline">
                                        Current Document
                                    </a>
                                </p>
                            @endif
                            <input type="file" name="requirement_document" id="requirement_document"
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @error('requirement_document')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Images -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Task Images (Max 5)
                            </label>
                            @if($task->images && count($task->images) > 0)
                                <div class="flex flex-wrap gap-2 mb-4">
                                    @foreach($task->images as $image)
                                        <div class="relative">
                                            <img src="{{ Storage::url($image) }}" alt="Task image" class="w-24 h-24 object-cover rounded">
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            <input type="file" name="images[]" id="images" multiple
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @error('images')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                            @error('images.*')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Team Members -->
                        <div class="mb-6">
                            <label for="team" class="block text-gray-700 text-sm font-bold mb-2">
                                Team Members
                            </label>
                            <select name="team[]" id="team" multiple
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @foreach($users as $user)
                                    @if($user->id != Auth::id())
                                        <option value="{{ $user->id }}" {{ in_array($user->id, old('team', $task->teamMembers->pluck('id')->toArray())) ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('team')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex items-center justify-end space-x-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Update Task
                            </button>
                            <a href="{{ route('tasks.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection