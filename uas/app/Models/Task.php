<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'division_id',
        'deadline', // Tambahkan deadline
    ];

    public function comments()
{
    return $this->hasMany(TaskComment::class);
}
}
