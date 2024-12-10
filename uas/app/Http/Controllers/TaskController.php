<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task; 

class TaskController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'status' => 'required|string|in:done,in_progress,not_yet',
            ]);

            $task = $validated;

            return response()->json($task, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    
    public function adminTodo()
    {
        $tasks = Task::all();
    
        $tasksGrouped = [
            'done' => $tasks->where('status', 'done'),
            'in_progress' => $tasks->where('status', 'in_progress'),
            'not_yet' => $tasks->where('status', 'not_yet'),
        ];
    
        return view('admin.todo_admin', compact('tasksGrouped'));
    }
    
    public function userTodo()
    {
        $tasks = Task::all();
    
        $tasksGrouped = [
            'done' => $tasks->where('status', 'done'),
            'in_progress' => $tasks->where('status', 'in_progress'),
            'not_yet' => $tasks->where('status', 'not_yet'),
        ];
    
        return view('User.todo_user', compact('tasksGrouped'));
    }
}
