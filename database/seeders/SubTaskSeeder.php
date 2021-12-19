<?php

namespace Database\Seeders;

use App\Models\SubTask;
use App\Models\Task;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class SubTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $task_id_array = Task::pluck('id');
        for ($i = 0; $i < 30; $i++) {
            $sub_task = new SubTask();
            $sub_task->task()->associate(Arr::random(Arr::flatten($task_id_array)));
            $sub_task->fill([
                'status' => Arr::random([true, false]),
                'title' => $faker->sentence,
            ])->save();
        }
    }
}
