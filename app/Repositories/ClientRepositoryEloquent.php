<?php

namespace ProjectManager\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use \ProjectManager\Presenters\ClientPresenter;

class ClientRepositoryEloquent extends BaseRepository implements ClientRepository
{
    public function model()
    {
        return 'ProjectManager\Entities\Client';
    }
    
    public function presenter() 
    {
        return ClientPresenter::class;
    }
} 