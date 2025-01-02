<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Division;
use App\Models\TaskComment;

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
                'deadline' => 'nullable|date',
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
        })
        ->with('comments.user')
        ->get();

        $tasksGrouped = [
            'done' => $tasks->where('status', 'done'),
            'in_progress' => $tasks->where('status', 'in_progress'),
            'not_yet' => $tasks->where('status', 'not_yet'),
        ];

        $divisions = Division::all();
        $currentDivision = $divisionId ? Division::find($divisionId) : null;
        $comments = TaskComment::with('user')->get();
        return view('admin.todo_admin', compact('tasksGrouped','tasks' , 'divisions', 'currentDivision', 'comments'));
    }

    public function show($id)
{
    $task = Task::findOrFail($id);
    return response()->json($task);
}

public function update(Request $request, $id)
{
    $task = Task::findOrFail($id);

    $task->update($request->only([
        'division_id', 'title', 'description', 'status', 'deadline'
    ]));
    
    if (!$task) {
        return back()->with('error', 'Task not found!');
    }
    return response()->json($task);
}



public function destroy($id)
{
    $task = Task::findOrFail($id);
    $task->delete();
    return response()->json(['success' => true]);
}


    public function userTodo(Request $request)
    {
        $divisionId = $request->input('division_id');
        $taskid = $request->input('task_id');

        $tasks = Task::when($divisionId, function ($query, $divisionId) {
            return $query->where('division_id', $divisionId);
        })
        ->with('comments.user')
        ->get();

        $tasksGrouped = [
            'done' => $tasks->where('status', 'done')->values(),
            'in_progress' => $tasks->where('status', 'in_progress')->values(),
            'not_yet' => $tasks->where('status', 'not_yet')->values(),
        ];

        $divisions = Division::all();
        $currentDivision = $divisionId ? Division::find($divisionId) : null;
        $comments = TaskComment::with('user', 'task')->get();
        return view('User.todo_user', compact('tasksGrouped', 'tasks', 'divisions', 'currentDivision', 'comments'));
    }

    public function updateStatus(Request $request, Task $task)
    {
        $validated = $request->validate([
            'status' => 'required|in:done,in_progress,not_yet',
        ]);

        $task->update(['status' => $validated['status']]);

        return response()->json(['success' => true, 'message' => 'Task status updated successfully!']);
    }

    public function showDivisionsUser()
    {
        $divisions = Division::all();

        return view('user.division_user', compact('divisions'));
    }

    public function showDivisionsAdmin()
    {
        $divisions = Division::all();

        return view('admin.division_admin', compact('divisions'));
    }

    
}
