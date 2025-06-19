
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Tasks</h1>
        <a href="{{ route('tasks.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Create New Task
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tasks Assigned by Me -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
        <div class="bg-gray-800 text-white px-6 py-4">
            <h2 class="text-xl font-semibold">Tasks Assigned by Me</h2>
        </div>
        
        <div class="p-6">
            @if($assignedTasks->isEmpty())
                <p class="text-gray-600">No tasks assigned by you.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="py-3 px-4 border-b border-gray-200 text-left">Title</th>
                                <th class="py-3 px-4 border-b border-gray-200 text-left">Project</th>
                                <th class="py-3 px-4 border-b border-gray-200 text-left">Assigned To</th>
                                <th class="py-3 px-4 border-b border-gray-200 text-left">Due Date</th>
                                <th class="py-3 px-4 border-b border-gray-200 text-left">Status</th>
                                <th class="py-3 px-4 border-b border-gray-200 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($assignedTasks as $task)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-3 px-4 border-b border-gray-200">{{ $task->title }}</td>
                                    <td class="py-3 px-4 border-b border-gray-200">{{ $task->project->title }}</td>
                                    <td class="py-3 px-4 border-b border-gray-200">{{ $task->assignee->name }}</td>
                                    <td class="py-3 px-4 border-b border-gray-200">{{ $task->due_date ? $task->due_date->format('M d, Y') : 'N/A' }}</td>
                                    <td class="py-3 px-4 border-b border-gray-200">
                                        <span class="px-2 py-1 rounded-full text-xs font-semibold 
                                            @if($task->status == 'completed') bg-green-100 text-green-800
                                            @elseif($task->status == 'in_progress') bg-blue-100 text-blue-800
                                            @elseif($task->status == 'testing') bg-purple-100 text-purple-800
                                            @elseif($task->status == 'on_hold') bg-yellow-100 text-yellow-800
                                            @elseif($task->status == 'cancelled') bg-red-100 text-red-800
                                            @else bg-gray-100 text-gray-800
                                            @endif">
                                            {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 border-b border-gray-200 space-x-2">
                                        <a href="{{ route('tasks.show', $task) }}" class="text-blue-500 hover:text-blue-700">
                                            <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </a>
                                        <a href="{{ route('tasks.edit', $task) }}" class="text-green-500 hover:text-green-700">
                                            <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure?')">
                                                <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <!-- Tasks Assigned to Me -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-gray-800 text-white px-6 py-4">
            <h2 class="text-xl font-semibold">Tasks Assigned to Me</h2>
        </div>
        
        <div class="p-6">
            @if($receivedTasks->isEmpty())
                <p class="text-gray-600">No tasks assigned to you.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="py-3 px-4 border-b border-gray-200 text-left">Title</th>
                                <th class="py-3 px-4 border-b border-gray-200 text-left">Project</th>
                                <th class="py-3 px-4 border-b border-gray-200 text-left">Assigned By</th>
                                <th class="py-3 px-4 border-b border-gray-200 text-left">Due Date</th>
                                <th class="py-3 px-4 border-b border-gray-200 text-left">Status</th>
                                <th class="py-3 px-4 border-b border-gray-200 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($receivedTasks as $task)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-3 px-4 border-b border-gray-200">{{ $task->title }}</td>
                                    <td class="py-3 px-4 border-b border-gray-200">{{ $task->project->title }}</td>
                                    <td class="py-3 px-4 border-b border-gray-200">{{ $task->assigner->name }}</td>
                                    <td class="py-3 px-4 border-b border-gray-200">{{ $task->due_date ? $task->due_date->format('M d, Y') : 'N/A' }}</td>
                                    <td class="py-3 px-4 border-b border-gray-200">
                                        <div x-data="{ open: false }" class="relative">
                                            <span @click="open = !open" class="px-2 py-1 rounded-full text-xs font-semibold cursor-pointer 
                                                @if($task->status == 'completed') bg-green-100 text-green-800
                                                @elseif($task->status == 'in_progress') bg-blue-100 text-blue-800
                                                @elseif($task->status == 'testing') bg-purple-100 text-purple-800
                                                @elseif($task->status == 'on_hold') bg-yellow-100 text-yellow-800
                                                @elseif($task->status == 'cancelled') bg-red-100 text-red-800
                                                @else bg-gray-100 text-gray-800
                                                @endif">
                                                {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                            </span>
                                            <div x-show="open" @click.away="open = false" 
                                                class="absolute left-0 mt-1 w-32 bg-white border rounded shadow-lg z-10" 
                                                x-transition>
                                                <form method="POST" action="{{ route('tasks.update', $task) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="title" value="{{ $task->title }}">
                                                    <input type="hidden" name="description" value="{{ $task->description }}">
                                                    <input type="hidden" name="assigned_to" value="{{ $task->assigned_to }}">
                                                    <input type="hidden" name="due_date" value="{{ $task->due_date ? $task->due_date->format('Y-m-d') : '' }}">
                                                    
                                                    <button type="submit" name="status" value="todo" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 {{ $task->status == 'todo' ? 'font-bold' : '' }}">TODO</button>
                                                    <button type="submit" name="status" value="in_progress" class="block w-full text-left px-4 py-2 text-blue-700 hover:bg-blue-100 {{ $task->status == 'in_progress' ? 'font-bold' : '' }}">In Progress</button>
                                                    <button type="submit" name="status" value="testing" class="block w-full text-left px-4 py-2 text-purple-700 hover:bg-purple-100 {{ $task->status == 'testing' ? 'font-bold' : '' }}">Testing</button>
                                                    <button type="submit" name="status" value="completed" class="block w-full text-left px-4 py-2 text-green-700 hover:bg-green-100 {{ $task->status == 'completed' ? 'font-bold' : '' }}">Completed</button>
                                                    <button type="submit" name="status" value="on_hold" class="block w-full text-left px-4 py-2 text-yellow-700 hover:bg-yellow-100 {{ $task->status == 'on_hold' ? 'font-bold' : '' }}">On Hold</button>
                                                    <button type="submit" name="status" value="cancelled" class="block w-full text-left px-4 py-2 text-red-700 hover:bg-red-100 {{ $task->status == 'cancelled' ? 'font-bold' : '' }}">Cancelled</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3 px-4 border-b border-gray-200">
                                        <a href="{{ route('tasks.show', $task) }}" class="text-blue-500 hover:text-blue-700">
                                            <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
@endpush