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
            'attachment' => ['nullable', 'file', 'max:10240', 'mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png,zip']
        ];
    }

    public function messages(): array
    {
        return [
            'assignee_id.integer' => 'ID исполнителя должен быть числом',
            'assignee_id.exists' => 'Выбранный исполнитель не существует',

            'name.required' => 'Название задачи обязательно для заполнения',
            'name.string' => 'Название задачи должно быть строкой',
            'name.max' => 'Название задачи не должно превышать 255 символов',

            'description.string' => 'Описание должно быть строкой',
            'description.max' => 'Описание не должно превышать 5000 символов',

            'due_date.date' => 'Дата завершения должна быть корректной датой',
            'due_date.after_or_equal' => 'Дата завершения не может быть в прошлом',

            'attachment.file' => 'Вложение должно быть файлом',
            'attachment.max' => 'Размер файла не должен превышать 10 МБ',
            'attachment.mimes' => 'Допустимые форматы файлов: pdf, doc, docx, xls, xlsx, jpg, jpeg, png, zip'
        ];
    }
}
