<?php

namespace App\Services;

use App\Mail\SendEmail;
use App\Models\Project\Task\Task;
use Illuminate\Support\Facades\Mail;

class EmailService
{
    public function send(Task $task): void
    {
        if ($task->assignee_id) { Mail::to($task->user->email)->send(new SendEmail(task: $task)); }
    }
}
