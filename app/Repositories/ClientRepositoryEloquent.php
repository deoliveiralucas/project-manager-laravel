<?php

namespace ProjectManager\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

class ClientRepositoryEloquent extends BaseRepository implements ClientRepository
{
    public function model()
    {
        return 'ProjectManager\Entities\Client';
    }
} 