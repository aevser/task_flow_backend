<?php

namespace App\Repositories\Task;


use App\Models\Project\Task\TaskStatus;

class TaskStatusRepository
{
    public function __construct(private TaskStatus $taskStatus){}

    public function findByType(string $type): ?int
    {
        return $this->taskStatus->query()->where('type', $type)->value('id');
    }
}
