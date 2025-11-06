<?php

namespace App\Services\Task;

use App\Enums\TaskStatus;
use App\Models\Project\Project;
use App\Models\Project\Task\Task;
use App\Repositories\Task\TaskRepository;
use App\Repositories\Task\TaskStatusRepository;
use App\Services\EmailService;
use Illuminate\Http\UploadedFile;

class TaskService
{
    public function __construct(
        private TaskRepository $taskRepository,
        private TaskStatusRepository $taskStatusRepository,
        private TaskAttachmentService $taskAttachmentService,
        private EmailService $emailService
    ){}

    public function create(Project $project, array $data, ?UploadedFile $attachment = null): array|Task
    {
        $plannedStatus = $this->taskStatusRepository->findByType(TaskStatus::PLANNED->value);

        $task = $this->taskRepository->create(project: $project, statusId: $plannedStatus, data: $data);

        if ($attachment) { $this->taskAttachmentService->addFile(task: $task, uploadedFile: $attachment); }

        $this->emailService->send(task: $task);

        return $task;
    }
}
