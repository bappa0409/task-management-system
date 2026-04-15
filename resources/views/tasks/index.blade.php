@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-2xl font-bold text-white text-2xl font-bold">Your Tasks</h2>
        <p class="text-gray-400 text-sm">Manage everything in one place</p>
    </div>

    <a href="{{ route('tasks.create') }}"
       class="cursor-pointer bg-blue-500/20 hover:bg-blue-500/30 text-white px-4 py-2 rounded-md text-sm transition">
        + Add Task
    </a>
</div>

@if(session('success'))
   <div class="bg-emerald-800 border border-green-400/50 shadow-md rounded-md p-4 mb-6">
        <p class="text-green-100">
            {{ session('success') }}
        </p>
    </div>
@endif

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

    @foreach($tasks as $task)
        @php
            $cardClass = match($task->status) {
                'completed' => 'bg-green-900/20 border-green-600',
                'in_progress' => 'bg-blue-900/20 border-blue-600',
                default => 'bg-gray-800 border-gray-700',
            };
        @endphp
        <div class="border rounded-md p-5 shadow-sm hover:shadow-2xl hover:-translate-y-1 transition-all duration-150 {{ $cardClass }}">

        <div class="flex justify-between items-start mb-3">
            <h3 class="text-lg font-semibold text-white leading-snug">
                {{ $task->title }}
            </h3>
            <form method="POST" action="{{ route('tasks.status', $task) }}">
                @csrf
                @method('PATCH')

            
                @php
                    $statusClass = $task->status == 'completed'
                        ? 'bg-green-600 border-green-500'
                        : ($task->status == 'in_progress'
                            ? 'bg-blue-600 border-blue-500'
                            : 'bg-yellow-600 border-yellow-500');
                @endphp
                <select name="status" onchange="this.form.submit()" class="text-xs text-white border rounded px-2 py-1 focus:outline-none transition
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

        <div class="flex items-center justify-between text-sm">
            <div class="flex items-center gap-2 text-gray-400">
                📅
                <span>Due:</span>
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

        <div class="flex gap-2 mt-3">
            <a href="{{ route('tasks.edit', $task) }}" class="flex-1 text-center bg-gray-700 hover:bg-gray-600 text-white text-xs py-1.5 rounded-md transition">
                Edit
            </a>

            <form method="POST" action="{{ route('tasks.destroy', $task) }}" class="flex-1">
                @csrf
                @method('DELETE')

                <button class="cursor-pointer w-full bg-red-600/20 hover:bg-red-600 text-red-300 hover:text-white text-xs py-1.5 rounded-md transition border border-red-500/30">
                    Delete
                </button>
            </form>
        </div>
    </div>
    @endforeach
</div>

@endsection