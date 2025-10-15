<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">Categories</h2>
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('categories.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">+ Add Category</a>
            @endif
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Success Message --}}
            @if(session('success'))
                <div 
                    id="flash-message"
                    class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4 transition-opacity duration-500"
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

            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            @if(Auth::user()->role === 'admin')
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($categories as $category)
                            <tr>
                                <td class="px-6 py-4">{{ $category->name }}</td>
                                <td class="px-6 py-4">{{ $category->description }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 rounded {{ $category->status == 'Active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $category->status }}
                                    </span>
                                </td>
                                @if(Auth::user()->role === 'admin')
                                <td class="px-6 py-4 text-center space-x-2">
                                    <a href="{{ route('categories.edit', $category) }}" class="text-blue-600 hover:underline">Edit</a>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 hover:underline" onclick="return confirm('Delete category?')">Delete</button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
