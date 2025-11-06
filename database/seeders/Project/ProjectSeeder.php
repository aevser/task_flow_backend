<?php

namespace Database\Seeders\Project;

use App\Models\Project\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // TODO добавить цикл
        Project::query()->create([
            'user_id' => 1,
            'name' => 'Project 1',
            'description' => 'Project 1 description',
            'enabled' => true
        ]);
    }
}
