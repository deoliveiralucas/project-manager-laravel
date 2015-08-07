<?php

namespace ProjectManager\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

class ProjectRepositoryEloquent extends BaseRepository implements ProjectRepository
{
    public function model()
    {
        return 'ProjectManager\Entities\Project';
    }
}
