<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Create Task</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto bg-white shadow-sm rounded-lg p-6">
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf

                <!-- Task Name -->
                <div class="mb-4">
                    <label class="block font-medium text-gray-700">Task Name</label>
                    <input type="text" name="task_name" value="{{ old('task_name') }}" class="w-full mt-1 border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                    @error('task_name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label class="block font-medium text-gray-700">Description</label>
                    <textarea name="description" class="w-full mt-1 border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">{{ old('description') }}</textarea>
                    @error('description') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Category -->
                <div class="mb-4">
                    <label class="block font-medium text-gray-700">Category</label>
                    <select name="category_id" class="w-full mt-1 border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="">-- Select Category --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Deadline -->
                <div class="mb-4">
                    <label class="block font-medium text-gray-700">Deadline</label>
                    <input type="date" name="deadline" value="{{ old('deadline') }}" class="w-full mt-1 border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                    @error('deadline') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Status -->
                <div class="mb-4">
                    <label class="block font-medium text-gray-700">Status</label>
                    <select name="status" class="w-full mt-1 border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        <option value="Pending">Pending</option>
                        <option value="In Progress">In Progress</option>
                        <option value="Completed">Completed</option>
                    </select>
                </div>

                <!-- Buttons -->
                <div class="flex justify-end space-x-2">
                    <a href="{{ route('tasks.index') }}" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">Cancel</a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Create Task</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
