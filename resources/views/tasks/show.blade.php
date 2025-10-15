<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Task Details</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto bg-white shadow-sm rounded-lg p-6 space-y-4">
            <div>
                <h3 class="font-medium text-gray-700">Task Name:</h3>
                <p class="text-gray-900">{{ $task->task_name }}</p>
            </div>

            <div>
                <h3 class="font-medium text-gray-700">Description:</h3>
                <p class="text-gray-900">{{ $task->description }}</p>
            </div>

            <div>
                <h3 class="font-medium text-gray-700">Category:</h3>
                <p class="text-gray-900">{{ $task->category->name }}</p>
            </div>

            <div>
                <h3 class="font-medium text-gray-700">Assigned User:</h3>
                <p class="text-gray-900">{{ $task->user->name }}</p>
            </div>

            <div>
                <h3 class="font-medium text-gray-700">Assignment Date:</h3>
                <p class="text-gray-900">{{ $task->assignment_date }}</p>
            </div>

            <div>
                <h3 class="font-medium text-gray-700">Deadline:</h3>
                <p class="text-gray-900">{{ $task->deadline }}</p>
            </div>

            <div>
                <h3 class="font-medium text-gray-700">Status:</h3>
                <p class="text-gray-900">{{ $task->status }}</p>
            </div>

            <div class="flex justify-end space-x-2">
                <a href="{{ route('tasks.index') }}" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">Back</a>
                <a href="{{ route('tasks.edit', $task) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Edit</a>
            </div>
        </div>
    </div>
</x-app-layout>
