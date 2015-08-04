<?php

use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \ProjectManager\Client::truncate();
        factory(\ProjectManager\Client::class, 10)->create();
    }
}
