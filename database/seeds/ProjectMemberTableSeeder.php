<?php

use Illuminate\Database\Seeder;

class ProjectMemberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProjectManager\Entities\ProjectMember::truncate();
        factory(\ProjectManager\Entities\ProjectMember::class, 35)->create();
    }
}
