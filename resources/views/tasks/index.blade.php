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
                    @foreach($tasks as $task)
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
                    @endforeach
                </tbody>
            </table>
        </div>
        </div>
    </div>
</x-app-layout>
