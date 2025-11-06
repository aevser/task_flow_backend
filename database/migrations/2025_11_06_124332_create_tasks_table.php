<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Статусы задачи
        Schema::create('task_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->timestamps();
        });

        \Illuminate\Support\Facades\DB::table('task_statuses')->insert([
            [
                'name' => 'Запланирована',
                'type' => 'planned',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'В процессе',
                'type' => 'in_progress',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Выполнена',
                'type' => 'done',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        // Задачи
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assignee_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->foreignId('status_id')->constrained('task_statuses')->cascadeOnDelete();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamp('due_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
        Schema::dropIfExists('task_statuses');
    }
};
