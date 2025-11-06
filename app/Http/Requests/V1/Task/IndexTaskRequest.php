<?php

namespace App\Http\Requests\V1\Task;

use Illuminate\Foundation\Http\FormRequest;

class IndexTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'assignee_id' => ['nullable', 'integer', 'exists:users,id'],
            'status_id' => ['nullable', 'integer', 'exists:task_statuses,id'],
            'due_date' => ['nullable', 'date', 'date_format:Y-m-d'],

            'perPage' => ['nullable', 'integer', 'min:1', 'max:100'],
            'page' => ['nullable', 'integer', 'min:1']
        ];
    }

    public function messages(): array
    {
        return [
            'assignee_id.integer' => __('validations.task.index.assignee_id.integer'),
            'assignee_id.exists' => __('validations.task.index.assignee_id.exists'),

            'status_id.integer' => __('validations.task.index.status_id.integer'),
            'status_id.exists' => __('validations.task.index.status_id.exists'),

            'due_date.date' => __('validations.task.index.due_date.date'),
            'due_date.date_format' => __('validations.task.index.due_date.date_format'),

            'perPage.integer' => __('validations.task.index.perPage.integer'),
            'perPage.min' => __('validations.task.index.perPage.min'),
            'perPage.max' => __('validations.task.index.perPage.max'),

            'page.integer' => __('validations.task.index.page.integer'),
            'page.min' => __('validations.task.index.page.min')
        ];
    }
}
