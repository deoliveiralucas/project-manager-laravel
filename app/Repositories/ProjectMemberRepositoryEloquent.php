<?php

namespace ProjectManager\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use ProjectManager\Presenters\ProjectMemberPresenter;

class ProjectMemberRepositoryEloquent extends BaseRepository implements ProjectMemberRepository
{
    public function model()
    {
        return 'ProjectManager\Entities\ProjectMember';
    }
    
    public function presenter() 
    {
        return ProjectMemberPresenter::class;
    }
}
