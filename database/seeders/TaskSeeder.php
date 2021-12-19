<?php

namespace Database\Seeders;

use App\Enums\TaskPrioType;
use App\Enums\TaskStatusType;
use App\Models\Task;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Date;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            Task::create([
                'title' => $faker->name(),
                'desc' => $faker->paragraph(),
                'due_date' => Date::now(),
                'spent_time' => Date::now()->format('H:i:s'),
                'status' => Arr::random(TaskStatusType::getValues()),
                'priority' => Arr::random(TaskPrioType::getValues()),
            ]);
        }
    }
}
