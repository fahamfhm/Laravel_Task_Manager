<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tasks</h2>
            <a href="{{ route('tasks.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">+ Add Task</a>
        </div>
    </x-slot>

    <div class="py-6">
         {{-- Success Message --}}
            @if(session('success'))
                <div 
                    id="flash-message"
                    class="bg-green-100 border border-green-400 text-green-700 w-[60%] mx-auto px-4 py-2 rounded mb-4 transition-opacity duration-500"
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

        <div class="overflow-x-auto bg-white shadow-md rounded-lg w-[90%] mx-auto">
            <table class="min-w-full border border-gray-200 rounded-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-4 text-left">Name</th>
                        <th class="py-3 px-4 text-left">Category</th>
                        <th class="py-3 px-4 text-left">Deadline</th>
                        <th class="py-3 px-4 text-left">Status</th>
                        <th class="py-3 px-4 text-left">Assigned User</th>
                        <th class="py-3 px-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="py-2 px-4">{{ $task->task_name }}</td>
                        <td class="py-2 px-4">{{ $task->category->name }}</td>
                        <td class="py-2 px-4">{{ $task->deadline }}</td>
                        <td class="py-2 px-4">
                            <span class="px-2 py-1 text-sm rounded 
                                {{ $task->status == 'Completed' ? 'bg-green-100 text-green-700' :
                                   ($task->status == 'In Progress' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                                {{ $task->status }}
                            </span>
                        </td>
                        <td class="py-2 px-4">{{ $task->user->name }}</td>
                        <td class="py-2 px-4 text-center space-x-2">
                            <a href="{{ route('tasks.edit', $task) }}" class="text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button class="text-red-600 hover:underline" onclick="return confirm('Delete task?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
