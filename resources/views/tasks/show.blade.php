<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Task Details</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6 space-y-4">
            <div>
                <h3 class="font-medium text-gray-700 dark:text-gray-300">Task Name:</h3>
                <p class="text-gray-900 dark:text-gray-100">{{ $task->task_name }}</p>
            </div>

            <div>
                <h3 class="font-medium text-gray-700 dark:text-gray-300">Description:</h3>
                <p class="text-gray-900 dark:text-gray-100">{{ $task->description }}</p>
            </div>

            <div>
                <h3 class="font-medium text-gray-700 dark:text-gray-300">Category:</h3>
                <p class="text-gray-900 dark:text-gray-100">{{ $task->category->name }}</p>
            </div>

            <div>
                <h3 class="font-medium text-gray-700 dark:text-gray-300">Assigned User:</h3>
                <p class="text-gray-900 dark:text-gray-100">{{ $task->user->name }}</p>
            </div>

            <div>
                <h3 class="font-medium text-gray-700 dark:text-gray-300">Assignment Date:</h3>
                <p class="text-gray-900 dark:text-gray-100">{{ $task->assignment_date }}</p>
            </div>

            <div>
                <h3 class="font-medium text-gray-700 dark:text-gray-300">Deadline:</h3>
                <p class="text-gray-900 dark:text-gray-100">{{ $task->deadline }}</p>
            </div>

            <div>
                <h3 class="font-medium text-gray-700 dark:text-gray-300">Status:</h3>
                <p class="text-gray-900 dark:text-gray-100">{{ $task->status }}</p>
            </div>

            <div class="flex justify-end space-x-2">
                <a href="{{ route('tasks.index') }}" class="px-4 py-2 bg-gray-300 dark:bg-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-400 dark:hover:bg-gray-500">Back</a>
                <a href="{{ route('tasks.edit', $task) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Edit</a>
            </div>
        </div>
    </div>
</x-app-layout>
