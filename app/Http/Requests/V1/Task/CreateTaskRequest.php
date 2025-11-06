<?php

namespace App\Http\Requests\V1\Task;

use Illuminate\Foundation\Http\FormRequest;

class CreateTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'assignee_id' => ['nullable', 'integer', 'exists:users,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'due_date' => ['nullable', 'date', 'after_or_equal:today'],
            'attachments' => ['nullable', 'array', 'max:5'],
            'attachments.*' => ['file', 'max:10240', 'mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png,zip']
        ];
    }

    public function messages(): array
    {
        return [
            'assignee_id.integer' => __('validations.task.create.assignee_id.integer'),
            'assignee_id.exists' => __('validations.task.create.assignee_id.exists'),

            'name.required' => __('validations.task.create.name.required'),
            'name.string' => __('validations.task.create.name.string'),
            'name.max' => __('validations.task.create.name.max'),

            'description.string' => __('validations.task.create.description.string'),
            'description.max' => __('validations.task.create.description.max'),

            'due_date.date' => __('validations.task.create.due_date.date'),
            'due_date.after_or_equal' => __('validations.task.create.due_date.after_or_equal'),

            'attachments.array' => __('validations.task.create.attachments.array'),
            'attachments.max' => __('validations.task.create.attachments.max'),
            'attachments.*.file' => __('validations.task.create.attachments.file'),
            'attachments.*.max' => __('validations.task.create.attachments.max_size'),
            'attachments.*.mimes' => __('validations.task.create.attachments.mimes')
        ];
    }
}
