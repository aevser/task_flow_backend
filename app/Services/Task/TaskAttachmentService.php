<?php

namespace App\Services\Task;

use App\Models\Project\Task\Task;
use Illuminate\Http\UploadedFile;

class TaskAttachmentService
{
    public function addFiles(Task $task, array $uploadedFiles): void
    {
        foreach ($uploadedFiles as $uploadedFile) {
            $this->addFile(task: $task, uploadedFile: $uploadedFile);
        }
    }
    public function addFile(Task $task, UploadedFile $uploadedFile): void
    {
        $task->addMedia($uploadedFile)
            ->usingFileName($this->generateName(uploadedFile: $uploadedFile))
            ->toMediaCollection('attachments');
    }

    private function generateName(UploadedFile $uploadedFile): string
    {
        return uniqid() . '-' . time() . '.' . $uploadedFile->getClientOriginalExtension();
    }
}
