<?php

namespace App\Services\Task;

use App\Enums\TaskStatus;
use App\Models\Project\Project;
use App\Models\Project\Task\Task;
use App\Repositories\Task\TaskRepository;
use App\Repositories\Task\TaskStatusRepository;
use App\Services\EmailService;

class TaskService
{
    public function __construct(
        private TaskRepository $taskRepository,
        private TaskStatusRepository $taskStatusRepository,
        private TaskAttachmentService $taskAttachmentService,
        private EmailService $emailService
    ){}

    public function create(Project $project, array $data, ?array $attachments = null): array|Task
    {
        $plannedStatus = $this->taskStatusRepository->findByType(TaskStatus::PLANNED->value);

        $task = $this->taskRepository->create(project: $project, statusId: $plannedStatus, data: $data);

        if ($attachments && count($attachments) > 0) { $this->taskAttachmentService->addFiles(task: $task, uploadedFiles: $attachments); }

        $this->emailService->send(task: $task);

        return $task;
    }
}
