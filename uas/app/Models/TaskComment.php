<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'user_id',
        'comment',
        'file_path',
    ];

    // Relasi ke task
    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
