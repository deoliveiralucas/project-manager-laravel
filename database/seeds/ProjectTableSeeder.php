<?php

use Illuminate\Database\Seeder;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProjectManager\Entities\Project::truncate();
        factory(\ProjectManager\Entities\Project::class, 10)->create();
    }
}
