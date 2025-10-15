<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $tasks = Task::with('category', 'user')->get();
        } else {
            $tasks = Task::with('category', 'user')->where('user_id', Auth::id())->get();
        }
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $categories = Category::all();
        return view('tasks.create', compact('categories', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validate the form
    $request->validate([
        'task_name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'category_id' => 'required|exists:categories,id',
        'deadline' => 'required|date|after:today',
        'status' => 'required|in:Pending,In Progress,Completed',
    ]);

    // Create the task
    Task::create([
        'task_name' => $request->task_name,
        'description' => $request->description,
        'category_id' => $request->category_id,
        'deadline' => $request->deadline,
        'status' => $request->status,
        'user_id' => $request->user_id,          // assign current user
        'assignment_date' => now(),         // automatically set assignment date
    ]);

    return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
}

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        if (Auth::user()->role !== 'admin' && $task->user_id !== Auth::id()) {
            return redirect()->route('tasks.index')->with('error', 'Unauthorized access.');
        }
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        if (Auth::user()->role !== 'admin' && $task->user_id !== Auth::id()) {
            return redirect()->route('tasks.index')->with('error', 'Unauthorized access.');
        }

        $users = User::all();
        $categories = Category::all();
        return view('tasks.edit', compact('task', 'categories', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        if(Auth::user()->role !== 'admin' && $task->user_id !== Auth::id()) {
            return redirect()->route('tasks.index')->with('error', 'Unauthorized access.');
        }

        $request->validate([
            'task_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'deadline' => 'required|date|after:today',
            'status' => 'required|in:Pending,In Progress,Completed',
        ]);

        $task->update($request->all());

        return to_route('tasks.index')->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        if(Auth::user()->role !== 'admin' && $task->user_id !== Auth::id()) {
            return redirect()->route('tasks.index')->with('error', 'Unauthorized access.');
        }

        $task->delete();
        return to_route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
