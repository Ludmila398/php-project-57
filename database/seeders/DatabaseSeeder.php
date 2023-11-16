<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TaskStatus;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $statusNames = [
            ['name' => 'новый'],
            ['name' => 'завершен'],
            ['name' => 'в работе'],
            ['name' => 'на тестировании'],
            ];

        foreach ($statusNames as $statusName) {
            TaskStatus::factory()->create($statusName);
        }
      
    }
}
