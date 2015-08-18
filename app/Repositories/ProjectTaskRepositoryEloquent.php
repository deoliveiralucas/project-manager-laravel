<?php

namespace ProjectManager\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

class ProjectTaskRepositoryEloquent extends BaseRepository implements ProjectTaskRepository
{
    public function model()
    {
        return 'ProjectManager\Entities\ProjectTask';
    }
}
