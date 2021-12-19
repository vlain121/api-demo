<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Task;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $categories = [];
        $task_id_array = Task::pluck('id');
        for ($i = 0; $i < 5; $i++) {
            $category = Category::create([
                'title' => $faker->company,
            ]);
            $categories[] = $category;
        }
        foreach ($categories as $category) {
            $category->tasks()->sync(Arr::random(Arr::flatten($task_id_array)), rand(0, 3));
        }
    }
}
