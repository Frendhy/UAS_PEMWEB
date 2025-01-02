<?php

namespace App\Http\Controllers;

use App\Models\TaskComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TaskCommentController extends Controller
{
    public function store(Request $request, $taskId)
    {
        $request->validate([
            'comment' => 'required|string',
            'file' => 'nullable|file|mimes:jpg,png,pdf,docx|max:2048', // Validasi file
        ]);

        // Upload file jika ada
        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('task_comments', 'public');
        }

        // Simpan data ke database
        TaskComment::create([
            'task_id' => $taskId,
            'user_id' => auth()->id(),
            'comment' => $request->comment,
            'file_path' => $filePath,
        ]);

        return redirect()->back()->with('success', 'Comment added successfully!');
    }
    
}
