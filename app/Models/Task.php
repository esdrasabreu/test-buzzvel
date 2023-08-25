<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $timestamps = false;
    protected $fillable = [
        'title', 'description', 'status', 'created_at', 'completed_at', 'updated_at', 'deleted_at', 'user_id'
    ];

    // Relação com o usuário
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relação com os anexos
    public function files()
    {
        return $this->hasMany(File::class, 'task_id');
    }
}
