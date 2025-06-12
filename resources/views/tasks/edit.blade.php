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
                    <form method="POST" action="{{ route('tasks.update', $task->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Title Field -->
                        <div class="mb-4">
                            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">
                                Title
                            </label>
                            <input id="title" type="text" 
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('title') border-red-500 @enderror" 
                                   name="title" 
                                   value="{{ old('title', $task->title) }}" 
                                   required 
                                   autocomplete="title" 
                                   autofocus>

                            @error('title')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description Field -->
                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">
                                Description
                            </label>
                            <textarea id="description" rows="3"
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('description') border-red-500 @enderror" 
                                   name="description" required>{{ old('description', $task->description) }}</textarea>

                            @error('description')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Assign To Field -->
                        <div class="mb-4">
                            <label for="assigned_to" class="block text-gray-700 text-sm font-bold mb-2">
                                Assign To
                            </label>
                            <select id="assigned_to" 
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('assigned_to') border-red-500 @enderror" 
                                   name="assigned_to" 
                                   required>
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

                        <!-- Due Date Field -->
                        <div class="mb-4">
                            <label for="due_date" class="block text-gray-700 text-sm font-bold mb-2">
                                Due Date
                            </label>
                            <input id="due_date" type="date" 
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('due_date') border-red-500 @enderror" 
                                   name="due_date" 
                                   value="{{ old('due_date', $task->due_date ? $task->due_date->format('Y-m-d') : '') }}">

                            @error('due_date')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status Field -->
                        <div class="mb-6">
                            <label for="status" class="block text-gray-700 text-sm font-bold mb-2">
                                Status
                            </label>
                            <select id="status" 
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('status') border-red-500 @enderror" 
                                   name="status" required>
                                <option value="pending" {{ old('status', $task->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="in_progress" {{ old('status', $task->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="completed" {{ old('status', $task->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>

                            @error('status')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Form Actions -->
                        <div class="flex items-center justify-end space-x-4">
                            <button type="submit" 
                                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Update Task
                            </button>
                            <a href="{{ route('tasks.index') }}" 
                              class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
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