<?php

use Illuminate\Database\Seeder;

class ProjectTaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProjectManager\Entities\ProjectTask::truncate();
        factory(\ProjectManager\Entities\ProjectTask::class, 20)->create();
    }
}
