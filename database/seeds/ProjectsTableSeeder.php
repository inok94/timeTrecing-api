<?php

use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('projects')->insert([
            'name'        => 'Project1',
            'description' => 'qqqqqqqqq',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('projects')->insert([
            'name'        => 'Project2',
            'description' => 'wwwwwwwww',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('projects')->insert([
            'name'        => 'Project3',
            'description' => 'eeeeeeeeee',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('projects')->insert([
            'name'        => 'Project4',
            'description' => 'rrrrrrrrrrr',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('projects')->insert([
            'name'        => 'Project5',
            'description' => 'ttttttttttt',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}