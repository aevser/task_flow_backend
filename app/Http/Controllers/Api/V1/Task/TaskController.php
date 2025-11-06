<?php

namespace App\Http\Controllers\Api\V1\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Task\CreateTaskRequest;
use App\Http\Requests\V1\Task\IndexTaskRequest;
use App\Http\Requests\V1\Task\UpdateTaskRequest;
use App\Models\Project\Project;
use App\Repositories\Task\TaskRepository;
use App\Services\TaskService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    use ApiResponse;

    public function __construct(private TaskRepository $taskRepository, private TaskService $taskService){}

    public function index(Project $project, IndexTaskRequest $request): JsonResponse
    {
        $tasks = $this->taskRepository->getAll(project: $project, filters: $request->validated());

        return $this->success(success: true, message: null, data: $tasks, code: JsonResponse::HTTP_OK);
    }

    public function show(int $id): JsonResponse
    {
        $task = $this->taskRepository->getOne(id: $id);

        return $this->success(success: true, message: null, data: $task, code: JsonResponse::HTTP_OK);
    }

    public function store(Project $project, CreateTaskRequest $request): JsonResponse
    {
        $task = $this->taskService->create(project: $project, data: $request->validated());

        return $this->success(success: true, message: 'Задача успешно добавлена.', data: $task, code: JsonResponse::HTTP_CREATED);
    }

    public function update(int $id, UpdateTaskRequest $request): JsonResponse
    {
        $task = $this->taskRepository->update(id: $id, data: $request->validated());

        return $this->success(success: true, message: 'Задача успешно обновлена.', data: $task, code: JsonResponse::HTTP_OK);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->taskRepository->delete(id: $id);

        return $this->success(success: true, message: 'Задача успешно удалена.', data: null, code: JsonResponse::HTTP_OK);
    }
}
