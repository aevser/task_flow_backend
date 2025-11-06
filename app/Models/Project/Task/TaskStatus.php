<?php

namespace App\Models\Project\Task;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TaskStatus extends Model
{
    protected $table = 'task_statuses';

    protected $fillable = ['name', 'type'];

    // Связи

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
