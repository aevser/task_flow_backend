<?php

namespace App\Services;

use App\Enums\TaskStatus;
use App\Models\Project\Project;
use App\Models\Project\Task\Task;
use App\Repositories\Task\TaskRepository;
use App\Repositories\Task\TaskStatusRepository;

class TaskService
{
    public function __construct(private TaskRepository $taskRepository, private TaskStatusRepository $taskStatusRepository){}

    public function create(Project $project, array $data): Task
    {
        $plannedStatus = $this->taskStatusRepository->findByType(TaskStatus::PLANNED->value);

        $task = $this->taskRepository->create(project: $project, statusId: $plannedStatus, data: $data);

        return $task;
    }
}
