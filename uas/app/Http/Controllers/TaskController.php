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
            'division_id' => 'required|exists:divisions,id', 
        ]);

        $task = Task::create($validated); 

        return response()->json($task, 201); 
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500); 
    }
}


    
public function adminTodo(Request $request)
{
    $divisionId = $request->query('division_id'); 

    $tasks = Task::when($divisionId, function ($query) use ($divisionId) {
        $query->where('division_id', $divisionId); 
    })->get();

    $tasksGrouped = [
        'done' => $tasks->where('status', 'done'),
        'in_progress' => $tasks->where('status', 'in_progress'),
        'not_yet' => $tasks->where('status', 'not_yet'),
    ];

    $divisions = \App\Models\Division::all(); 

    return view('admin.todo_admin', compact('tasksGrouped', 'divisions'));
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
