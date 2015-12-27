<?php

namespace ProjectManager\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use ProjectManager\Presenters\ProjectFilePresenter;

class ProjectFileRepositoryEloquent extends BaseRepository implements ProjectFileRepository
{
    public function model()
    {
        return 'ProjectManager\Entities\ProjectFile';
    }
    
    public function presenter()
    {
        return ProjectFilePresenter::class;
    }
}
