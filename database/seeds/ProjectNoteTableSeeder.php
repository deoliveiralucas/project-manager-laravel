<?php

use Illuminate\Database\Seeder;

class ProjectNoteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProjectManager\Entities\ProjectNote::truncate();
        factory(\ProjectManager\Entities\ProjectNote::class, 50)->create();
    }
}
