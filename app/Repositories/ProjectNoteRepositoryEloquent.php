<?php

namespace ProjectManager\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

class ProjectNoteRepositoryEloquent extends BaseRepository implements ProjectNoteRepository
{
    public function model()
    {
        return 'ProjectManager\Entities\ProjectNote';
    }
}
