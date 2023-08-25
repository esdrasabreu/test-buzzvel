<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use HasFactory, HasTimestamps;
    protected $fillable = [
        'file_path', 'task_id'
    ];
    // Relação com a tarefa
    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }
}
