<?php

namespace App\Repositories\Task;

use App\Constants\PaginationAndSort;
use App\Models\Project\Project;
use App\Models\Project\Task\Task;
use Illuminate\Pagination\LengthAwarePaginator;

class TaskRepository
{
    private const array RELATIONS = ['user', 'project', 'status'];

    public function __construct(private Task $task){}

    public function getAll(Project $project, array $filters): LengthAwarePaginator
    {
        return $this->task->query()
            ->with(self::RELATIONS)
            ->applyFilters($filters)
            ->where('project_id', $project->id)
            ->orderBy(PaginationAndSort::SORT_COLUMN, PaginationAndSort::SORT_DIRECTION_DESC)
            ->paginate($filters['perPage'] ?? PaginationAndSort::PAGINATION_PER_PAGE);
    }

    public function getOne(int $id): Task
    {
        return $this->task->query()->findOrFail($id);
    }

    public function create(Project $project, int $statusId, array $data): Task
    {
        $data['project_id'] = $project->id;

        $data['status_id'] = $statusId;

        return $this->task->query()->create($data)->fresh(self::RELATIONS);
    }

    public function update(int $id, array $data): Task
    {
        $task = $this->task->query()->findOrFail($id);

        $task->update($data);

        return $task->fresh(self::RELATIONS);
    }

    public function delete(int $id): bool
    {
        return $this->task->query()->findOrFail($id)->delete();
    }
}
