<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Welcome Message --}}
            <div class="bg-gradient-to-r from-black via-blue-800 to-blue-600 text-white rounded-2xl shadow-md p-8 mb-8">
                <h1 class="text-3xl font-bold mb-2">Welcome, {{ Auth::user()->name }} 🎉</h1>
                <p class="text-lg">
                    @if(Auth::user()->role === 'admin')
                        You’re logged in as an <strong>Admin</strong>. You can manage all tasks and categories.
                    @else
                        You’re logged in as an <strong>Intern</strong>. You can manage your own tasks.
                    @endif
                </p>
            </div>

            {{-- Quick Stats --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                    <h3 class="text-gray-500 text-sm font-medium">Total Tasks</h3>
                    <p class="text-3xl font-bold text-indigo-600">{{ $totalTasks ?? 0 }}</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                    <h3 class="text-gray-500 text-sm font-medium">Completed Tasks</h3>
                    <p class="text-3xl font-bold text-green-600">{{ $completedTasks ?? 0 }}</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                    <h3 class="text-gray-500 text-sm font-medium">Pending Tasks</h3>
                    <p class="text-3xl font-bold text-yellow-500">{{ $pendingTasks ?? 0 }}</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                    <h3 class="text-gray-500 text-sm font-medium">Categories</h3>
                    <p class="text-3xl font-bold text-purple-600">{{ $totalCategories ?? 0 }}</p>
                </div>
            </div>

            {{-- Quick Links --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                <a href="{{ route('tasks.index') }}" class="bg-blue-900 hover:bg-blue-700 text-white p-6 rounded-xl shadow text-center transition">
                    <h4 class="text-xl font-semibold mb-1">Manage Tasks</h4>
                    <p class="text-sm opacity-80">View, edit, and assign tasks.</p>
                </a>

                <a href="{{ route('categories.index') }}" class="bg-blue-900 hover:bg-blue-700 text-white p-6 rounded-xl shadow text-center transition">
                    <h4 class="text-xl font-semibold mb-1">Manage Categories</h4>
                    <p class="text-sm opacity-80">Add or edit task categories.</p>
                </a>

                {{-- @if(Auth::user()->role === 'admin')
                    <a href="#" class="bg-pink-600 hover:bg-pink-700 text-white p-6 rounded-xl shadow text-center transition opacity-70 cursor-not-allowed">
                        <h4 class="text-xl font-semibold mb-1">Manage Interns</h4>
                        <p class="text-sm opacity-80">Feature coming soon</p>
                    </a>
                @endif --}}

            </div>
        </div>
    </div>
</x-app-layout>
