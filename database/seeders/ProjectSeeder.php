<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 4; $i++) {
            Project::create([
                'name' => $faker->company(),
                'description' => $faker->paragraph(),
            ]);
        }
    }
}
