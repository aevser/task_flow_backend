<?php

namespace App\Traits\Task\Filter;

use Illuminate\Database\Eloquent\Builder;

trait Filter
{
    public function scopeApplyFilters(Builder $query, array $filters): Builder
    {
        return $query
            ->when(
                isset($filters['assignee_id']),
                fn ($q) => $q->filterByAssigneeId($filters['assignee_id'])
            )
            ->when(
                isset($filters['status_id']),
                fn ($q) => $q->filterByStatusId($filters['status_id'])
            )
            ->when(
                isset($filters['due_date']),
                fn ($q) => $q->filterByDueDate($filters['due_date'])
            );
    }

    public function scopeFilterByAssigneeId(Builder $query, int|array $assigneeId): Builder
    {
        $ids = is_array($assigneeId) ? $assigneeId : [$assigneeId];

        return $query->whereIn('assignee_id', $ids);
    }

    public function scopeFilterByStatusId(Builder $query, int|array $statusId): Builder
    {
        $ids = is_array($statusId) ? $statusId : [$statusId];

        return $query->whereIn('status_id', $ids);
    }

    public function scopeFilterByDueDate(Builder $query, string $dueDate): Builder
    {
        return $query->whereDate('due_date', $dueDate);
    }
}
