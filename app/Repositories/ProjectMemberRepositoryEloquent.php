<?php

namespace ProjectManager\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

class ProjectMemberRepositoryEloquent extends BaseRepository implements ProjectMemberRepository
{
    public function model()
    {
        return 'ProjectManager\Entities\ProjectMember';
    }
}
