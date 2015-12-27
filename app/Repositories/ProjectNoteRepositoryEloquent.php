<?php

namespace ProjectManager\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use ProjectManager\Presenters\ProjectNotePresenter;

class ProjectNoteRepositoryEloquent extends BaseRepository implements ProjectNoteRepository
{
    public function model()
    {
        return 'ProjectManager\Entities\ProjectNote';
    }
    
    public function presenter()
    {
        return ProjectNotePresenter::class;
    }
}
