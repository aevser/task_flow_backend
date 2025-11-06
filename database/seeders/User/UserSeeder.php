<?php

namespace Database\Seeders\User;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            User::query()->create([
                'name' => 'user' . $i,
                'email' => '1@' . $i . '.ru',
                'password' => Hash::make('123456')
            ]);
        }
    }
}
