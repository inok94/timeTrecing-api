<?php

use Illuminate\Database\Seeder;

class ProjectEmployeeTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create();

        $limit = 10;

        for ($i = 0; $i<$limit;$i++) {
            DB::table('project_employees')->insert([
                'employee_id'   => $faker->numberBetween('1','6'),
                'project_id'   => $faker->numberBetween('1','5'),
                'date'   => $faker->dateTimeBetween('now','now'),
                'started_work'   => $faker->time('H:i:s','-1 now'),
                'finished_work'     => $faker->time('H:i:s','+1 now'),
            ]);
        }
    }
}