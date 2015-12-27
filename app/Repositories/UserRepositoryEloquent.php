<?php

namespace ProjectManager\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use \ProjectManager\Presenters\UserPresenter;

class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    public function model()
    {
        return 'ProjectManager\Entities\User';
    }
    
    public function presenter()
    {
        return UserPresenter::class;
    }
}
