<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('clients')->insert([
            'name'        => 'Client1',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('clients')->insert([
            'name'        => 'Client2',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('clients')->insert([
            'name'        => 'Client3',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('clients')->insert([
            'name'        => 'Client4',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('clients')->insert([
            'name'        => 'Client5',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}