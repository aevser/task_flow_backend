<?php

namespace Database\Seeders\Project;

use App\Models\Project\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $faker = \Faker\Factory::create();

        foreach ($users as $user) {
            $projectCounts = rand(1, 3);

            for ($i = 0; $i < $projectCounts; $i++) {
                Project::query()->create([
                    'user_id' => $user->id,
                    'name' => $faker->sentence(3),
                    'description' => $faker->paragraph(2),
                    'enabled' => $faker->boolean(80),
                ]);
            }
        }
    }
}
