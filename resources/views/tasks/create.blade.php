@extends('layouts.app')

@section('content')
    <div class="bg-gray-800 border border-gray-700 rounded-md shadow-xl p-6 max-w-4xl mx-auto">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-white">Create New Task</h2>
                <p class="text-gray-400 text-sm mt-1">
                    Fill in the details below to add a new task
                </p>
            </div>

            <a href="{{ route('tasks.index') }}"
            class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-md text-sm transition">
                ← Back to Tasks
            </a>
        </div>

        <form method="POST" action="{{ route('tasks.store') }}" class="space-y-2">
            @csrf

            <div>
                <label class="block text-sm text-gray-300 mb-1">Task Title</label>
                <input type="text" name="title"
                    class="w-full bg-gray-900 border border-gray-700 text-white
                            rounded-md px-4 py-2 focus:outline-none focus:border-blue-300/60 focus:ring-1 focus:ring-blue-300/20">

                @error('title')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm text-gray-300 mb-1">Description</label>
                <textarea name="description" rows="4"
                        class="w-full bg-gray-900 border border-gray-700 text-white
                                rounded-md px-4 py-2 focus:outline-none focus:border-blue-300/60 focus:ring-1 focus:ring-blue-300/20"></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <div>
                    <label class="block text-sm text-gray-300 mb-1">Status</label>
                    <select name="status"
                            class="w-full bg-gray-900 border border-gray-700 text-white
                                rounded-md px-4 py-2 focus:outline-none focus:border-blue-300/60 focus:ring-1 focus:ring-blue-300/20">
                        <option value="" selected>Select Status</option>
                        <option value="pending">Pending</option>
                        <option value="in_progress">In Progress</option>
                        <option value="completed">Completed</option>
                    </select>

                    @error('status')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm text-gray-300 mb-1">Due Date</label>

                    <div class="relative">
                        <input type="text" id="due_date" name="due_date" autocomplete="off" placeholder="Select date" class="w-full bg-gray-900 border border-gray-700 text-white rounded-md px-4 py-2 pl-11 focus:outline-none focus:border-blue-300/60 focus:ring-1 focus:ring-blue-300/20">

                        <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                            📅 
                        </div>
                    </div>

                    @error('due_date')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="my-4 border-t border-gray-700"></div>

            <div class="flex justify-end">
                <button type="submit" class="cursor-pointer bg-blue-500/20 hover:bg-blue-500/30 text-white px-4 py-2 rounded-md text-sm transition">Save Task</button>
            </div>
        </form>
    </div>
@endsection