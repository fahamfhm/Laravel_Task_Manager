<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Tasks</h2>
            <a href="{{ route('tasks.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">+ Add Task</a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
         {{-- Success Message --}}
            @if(session('success'))
                <div 
                    id="flash-message"
                    class="bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-700 text-green-700 dark:text-green-300 px-4 py-2 rounded mb-4 transition-opacity duration-500"
                >
                    {{ session('success') }}
                </div>
                <script>
                    setTimeout(() => {
                        const msg = document.getElementById('flash-message');
                        if(msg){
                            msg.style.opacity = '0';
                            setTimeout(() => msg.remove(), 500);
                        }
                    }, 3000);
                </script>
            @endif

            {{-- Filter Section --}}
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-4 mb-4">
                <form method="GET" action="{{ route('tasks.index') }}" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    {{-- Search by Task Name --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Search Task</label>
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}"
                            placeholder="Search by task name..."
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                        >
                    </div>

                    {{-- Filter by Status --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                        <select 
                            name="status" 
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                        >
                            <option value="">All Status</option>
                            <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="In Progress" {{ request('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="Completed" {{ request('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>

                    {{-- Filter by Category --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Category</label>
                        <select 
                            name="category_id" 
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                        >
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Filter by User (Admin Only) --}}
                    @if(auth()->user()->role === 'admin')
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Assigned User</label>
                        <select 
                            name="user_id" 
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                        >
                            <option value="">All Users</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @endif

                    {{-- Filter Actions --}}
                    <div class="flex items-end gap-2 {{ auth()->user()->role !== 'admin' ? 'md:col-span-1' : '' }}">
                        <button 
                            type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition"
                        >
                            <svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Filter
                        </button>
                        <a 
                            href="{{ route('tasks.index') }}" 
                            class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-400 dark:hover:bg-gray-500 transition"
                        >
                            <svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Clear
                        </a>
                    </div>
                </form>
            </div>

        {{-- Results Count --}}
        @if(request()->hasAny(['search', 'status', 'category_id', 'user_id']))
        <div class="mb-3 text-sm text-gray-600 dark:text-gray-400">
            Showing {{ $tasks->count() }} result(s)
            @if(request('search'))
                for "<strong>{{ request('search') }}</strong>"
            @endif
        </div>
        @endif

        <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow-md rounded-lg ">
            <table class="min-w-full border border-gray-200 dark:border-gray-700 rounded-lg">
                <thead class="bg-gray-100 dark:bg-gray-700">
                    <tr>
                        <th class="py-3 px-4 text-left dark:text-gray-200">Name</th>
                        <th class="py-3 px-4 text-left dark:text-gray-200">Category</th>
                        <th class="py-3 px-4 text-left dark:text-gray-200">Deadline</th>
                        <th class="py-3 px-4 text-left dark:text-gray-200">Status</th>
                        <th class="py-3 px-4 text-left dark:text-gray-200">Assigned User</th>
                        <th class="py-3 px-4 text-center dark:text-gray-200">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tasks as $task)
                    <tr class="border-t dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="py-2 px-4 dark:text-gray-300">{{ $task->task_name }}</td>
                        <td class="py-2 px-4 dark:text-gray-300">{{ $task->category->name }}</td>
                        <td class="py-2 px-4 dark:text-gray-300">{{ $task->deadline }}</td>
                        <td class="py-2 px-4">
                            <span class="px-2 py-1 text-sm rounded 
                                {{ $task->status == 'Completed' ? 'bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300' :
                                   ($task->status == 'In Progress' ? 'bg-yellow-100 dark:bg-yellow-900 text-yellow-700 dark:text-yellow-300' : 'bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-300') }}">
                                {{ $task->status }}
                            </span>
                        </td>
                        <td class="py-2 px-4 dark:text-gray-300">{{ $task->user->name }}</td>
                        <td class="py-2 px-4 text-center space-x-2">
                            <a href="{{ route('tasks.edit', $task) }}" class="text-blue-600 dark:text-blue-400 hover:underline">Edit</a>
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button class="text-red-600 dark:text-red-400 hover:underline" onclick="return confirm('Delete task?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-8 px-4 text-center text-gray-500 dark:text-gray-400">
                            <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            <p class="mt-2 text-sm font-medium">No tasks found</p>
                            @if(request()->hasAny(['search', 'status', 'category_id', 'user_id']))
                                <p class="mt-1 text-xs">Try adjusting your filters</p>
                            @else
                                <p class="mt-1 text-xs">Create your first task to get started</p>
                            @endif
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        </div>
    </div>
</x-app-layout>
