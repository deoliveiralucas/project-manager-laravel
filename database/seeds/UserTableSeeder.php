<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProjectManager\Entities\User::truncate();
        factory(\ProjectManager\Entities\User::class, 10)->create();
    }
}
