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
        ProjectManager\Entities\Client::truncate();
        factory(\ProjectManager\Entities\Client::class, 10)->create();
    }
}