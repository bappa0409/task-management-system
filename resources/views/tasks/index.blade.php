@extends('layouts.app')

@section('content')

<div class="border border-gray-700 bg-gray-800 rounded-md p-4 sm:p-6 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6">
    <div>
        <h2 class="text-xl sm:text-2xl font-bold text-white">Your Tasks</h2>
        <p class="text-gray-400 text-xs sm:text-sm">Manage everything in one place</p>
    </div>

    <a href="{{ route('tasks.create') }}"
       class="w-full sm:w-auto text-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm transition">
        + Add Task
    </a>
</div>

@if(session('success'))
   <div class="bg-emerald-800 border border-green-400/50 shadow-md rounded-md p-3 sm:p-4 mb-6">
        <p class="text-green-100 text-sm">
            {{ session('success') }}
        </p>
    </div>
@endif

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-5">

    @foreach($tasks as $task)
        @php
            $cardClass = match($task->status) {
                'completed' => 'bg-green-900/20 border-green-600',
                'in_progress' => 'bg-blue-900/20 border-blue-600',
                default => 'bg-gray-800 border-gray-700',
            };
        @endphp

        <div class="border rounded-md p-4 sm:p-5 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-150 {{ $cardClass }}">

        <div class="flex flex-col gap-2 sm:flex-row sm:justify-between sm:items-start mb-3">
            <h3 class="text-base sm:text-lg font-semibold text-white leading-snug">
                {{ $task->title }}
            </h3>

            <form method="POST" action="{{ route('tasks.status', $task) }}">
                @csrf
                @method('PATCH')

                <select name="status" onchange="this.form.submit()" 
                    class="w-full sm:w-auto text-xs text-white border rounded px-2 py-1 focus:outline-none transition
                    @if($task->status == 'completed')
                        bg-green-600 border-green-500
                    @elseif($task->status == 'in_progress')
                        bg-blue-600 border-blue-500
                    @else
                        bg-yellow-600 border-yellow-500
                    @endif
                ">
                    <option value="pending" @selected($task->status=='pending')>Pending</option>
                    <option value="in_progress" @selected($task->status=='in_progress')>In Progress</option>
                    <option value="completed" @selected($task->status=='completed')>Completed</option>
                </select>
            </form>
        </div>

        <p class="text-gray-400 text-sm leading-relaxed min-h-[40px]">
            {{ $task->description ?? 'No description provided' }}
        </p>

        <div class="my-2 border-t border-gray-700"></div>

        <div class="flex items-center justify-between text-xs sm:text-sm">
            <div class="flex items-center gap-2 text-gray-400">
                📅 <span>Due:</span>
            </div>

            <span class="
                @if($task->due_date && $task->due_date < now()->toDateString())
                    text-red-400 font-semibold
                @else
                    text-gray-300
                @endif
            ">
                {{ $task->due_date ?? 'No deadline' }}
            </span>
        </div>

        <div class="flex flex-col sm:flex-row gap-2 mt-3">
            <a href="{{ route('tasks.edit', $task) }}"
               class="w-full text-center bg-gray-700 hover:bg-gray-600 text-white text-xs py-2 rounded-md transition">
                Edit
            </a>

            <form method="POST" action="{{ route('tasks.destroy', $task) }}" class="w-full">
                @csrf
                @method('DELETE')

                <button class="w-full bg-red-600/20 hover:bg-red-600 text-red-300 hover:text-white text-xs py-2 rounded-md transition border border-red-500/30">
                    Delete
                </button>
            </form>
        </div>

    </div>
    @endforeach
</div>

@endsection