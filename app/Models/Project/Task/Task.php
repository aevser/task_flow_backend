<?php

namespace App\Models\Project\Task;

use App\Models\Project\Project;
use App\Models\User;
use App\Traits\Task\Filter\Filter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use Filter;

    protected $fillable = ['assignee_id', 'project_id', 'status_id', 'name', 'description', 'due_date'];

    // Связи

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(TaskStatus::class);
    }
}
