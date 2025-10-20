<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Create Category</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block font-medium text-gray-700 dark:text-gray-300">Category Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="w-full mt-1 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                    @error('name') <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-gray-700 dark:text-gray-300">Description</label>
                    <textarea name="description" class="w-full mt-1 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">{{ old('description') }}</textarea>
                    @error('description') <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-gray-700 dark:text-gray-300">Status</label>
                    <select name="status" class="w-full mt-1 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                    @error('status') <span class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end space-x-2">
                    <a href="{{ route('categories.index') }}" class="px-4 py-2 bg-gray-300 dark:bg-gray-600 dark:text-gray-300 rounded-lg hover:bg-gray-400 dark:hover:bg-gray-500">Cancel</a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Create</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
