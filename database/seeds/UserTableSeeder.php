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
        factory(\ProjectManager\Entities\User::class)->create([
            'name' => 'Lucas',
            'email' => 'contato@deoliveiralucas.net',
            'password' => bcrypt('123456'),
            'remember_token' => str_random(10),
        ]);
        
        factory(\ProjectManager\Entities\User::class, 10)->create();
    }
}
