<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $totalTasks = $user->role === 'admin'
            ? \App\Models\Task::count()
            : \App\Models\Task::where('user_id', $user->id)->count();

        $completedTasks = $user->role === 'admin'
            ? \App\Models\Task::where('status', 'completed')->count()
            : \App\Models\Task::where('user_id', $user->id)->where('status', 'completed')->count();

        $pendingTasks = $user->role === 'admin'
            ? \App\Models\Task::where('status', 'pending')->count()
            : \App\Models\Task::where('user_id', $user->id)->where('status', 'pending')->count();

        $totalCategories = \App\Models\Category::count();

        return view('dashboard', compact('totalTasks', 'completedTasks', 'pendingTasks', 'totalCategories'));
    }
}
