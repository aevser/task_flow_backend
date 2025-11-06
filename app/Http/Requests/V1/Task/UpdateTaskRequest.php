<?php

namespace App\Http\Requests\V1\Task;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'assignee_id' => ['nullable', 'integer', 'exists:users,id'],
            'status_id' => ['required', 'integer', 'exists:task_statuses,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'due_date' => ['nullable', 'date', 'after_or_equal:today']
        ];
    }

    public function messages(): array
    {
        return [
            'assignee_id.integer' => __('validations.task.update.assignee_id.integer'),
            'assignee_id.exists' => __('validations.task.update.assignee_id.exists'),

            'status_id.required' => __('validations.task.update.status_id.required'),
            'status_id.integer' => __('validations.task.update.status_id.integer'),
            'status_id.exists' => __('validations.task.update.status_id.exists'),

            'name.required' => __('validations.task.update.name.required'),
            'name.string' => __('validations.task.update.name.string'),
            'name.max' => __('validations.task.update.name.max'),

            'description.string' => __('validations.task.update.description.string'),
            'description.max' => __('validations.task.update.description.max'),

            'due_date.date' => __('validations.task.update.due_date.date'),
            'due_date.after_or_equal' => __('validations.update.task.due_date.after_or_equal')
        ];
    }
}
