<?php

namespace Database\Seeders\Project\Task;

use App\Models\Project\Project;
use App\Models\Project\Task\Task;
use App\Models\Project\Task\TaskStatus;
use App\Models\User;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $projects = Project::all();
        $statuses  = TaskStatus::all();

        $taskNames = [
            'Разработать API эндпоинт',
            'Исправить баг в авторизации',
            'Добавить валидацию форм',
            'Оптимизировать запросы к БД',
            'Написать документацию',
            'Провести code review',
            'Настроить CI/CD',
            'Добавить юнит-тесты',
            'Рефакторинг компонента',
            'Интеграция с внешним API',
            'Создать миграцию БД',
            'Дизайн новой страницы',
            'Исправить responsive layout',
            'Добавить логирование',
            'Настроить мониторинг'
        ];

        $taskDescriptions = [
            'Необходимо реализовать функционал согласно требованиям',
            'Критическая ошибка, требует немедленного исправления',
            'Добавить проверку входных данных',
            'Улучшить производительность приложения',
            'Создать подробную техническую документацию',
            null,
            'Автоматизировать процесс развертывания',
            'Покрыть тестами критичную функциональность'
        ];

        foreach ($projects as $project) {
            $taskCounts = rand(3, 15);

            for ($i = 0; $i < $taskCounts; $i++) {
                Task::query()->create([
                    'assignee_id' => $users->random()->id,
                    'project_id' => $project->id,
                    'status_id' => $statuses->random()->id,
                    'name' => $taskNames[array_rand($taskNames)],
                    'description' => $taskDescriptions[array_rand($taskDescriptions)],
                    'due_date' => rand(0, 1) ? now()->addDays(rand(1, 60)) : null,
                    'created_at' => now()->subDays(rand(0, 30)),
                    'updated_at' => now()->subDays(rand(0, 10))
                ]);
            }
        }
    }
}
