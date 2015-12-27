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
    
    public function updateMember(array $data, $idProject, $idUser)
    {
        return $this
            ->model
            ->where('project_id', $idProject)
            ->where('user_id', $idUser)
            ->update($data);
    }
    
    public function deleteMember($idProject, $idUser)
    {
        return $this
            ->model
            ->where('project_id', $idProject)
            ->where('user_id', $idUser)
            ->delete();
    }
    
    public function presenter()
    {
        return ProjectMemberPresenter::class;
    }
}
