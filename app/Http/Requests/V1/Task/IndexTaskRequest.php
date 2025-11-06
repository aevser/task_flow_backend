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
            'assignee_id.integer' => 'ID исполнителя должен быть числом',
            'assignee_id.exists' => 'Выбранный исполнитель не существует',

            'status_id.integer' => 'ID статуса должен быть числом',
            'status_id.exists' => 'Выбранный статус не существует',

            'due_date.date' => 'Дата завершения должна быть корректной датой',
            'due_date.date_format' => 'Формат даты должен быть Y-m-d (например, 2025-11-06)',

            'perPage.integer' => 'Количество элементов на странице должно быть числом',
            'perPage.min' => 'Минимальное количество элементов на странице: 1',
            'perPage.max' => 'Максимальное количество элементов на странице: 100',

            'page.integer' => 'Номер страницы должен быть числом',
            'page.min' => 'Номер страницы должен быть больше 0'
        ];
    }
}
