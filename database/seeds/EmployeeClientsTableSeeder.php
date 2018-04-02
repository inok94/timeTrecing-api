<?php

use Illuminate\Database\Seeder;

class EmployeeClientsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create();

        $limit = 10;
        for ($i = 0; $i < $limit; $i++) {
            DB::table('employeeсlients')->insert([
                'employee_id'   => $faker->numberBetween('1','6'),
                'client_id'     => $faker->numberBetween('1','5'),
                'date'   => $faker->dateTimeBetween('now','now'),
                'started_work'   => $faker->time('H:i:s','-1 now'),
                'finished_work'     => $faker->time('H:i:s','+1 now'),
            ]);
        }
    }
}