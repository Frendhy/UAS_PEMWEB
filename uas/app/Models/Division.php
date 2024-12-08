<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    protected $fillable = [
        'divisi_name',
    ];

    /**
     * Relationship: A division can have many users.
     */
    public function users()
    {
        return $this->hasMany(User::class, 'division_id');
    }
}
