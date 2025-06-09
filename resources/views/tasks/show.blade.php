@extends('layout.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-center">
        <div class="w-full max-w-2xl">
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
                            <p class="text-gray-900">{{ $task->description ?? 'N/A' }}</p>
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

                    <!-- Due Date -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <label class="text-gray-700 font-medium md:text-right md:col-span-1">Due Date</label>
                        <div class="md:col-span-3">
                            <p class="text-gray-900">{{ $task->due_date ? $task->due_date->format('Y-m-d') : 'N/A' }}</p>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <label class="text-gray-700 font-medium md:text-right md:col-span-1">Status</label>
                        <div class="md:col-span-3">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                @if($task->status == 'completed') bg-green-100 text-green-800
                                @elseif($task->status == 'in_progress') bg-blue-100 text-blue-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                            </span>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-wrap justify-end space-x-4 pt-6">
                        <a href="{{ route('tasks.index') }}" 
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Back to List
                        </a>
                        @can('update', $task)
                            <a href="{{ route('tasks.edit', $task) }}" 
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Edit
                            </a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection