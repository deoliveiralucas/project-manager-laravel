<?php

namespace ProjectManager\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use ProjectManager\Presenters\ProjectPresenter;

class ProjectRepositoryEloquent extends BaseRepository implements ProjectRepository
{
    public function model()
    {
        return 'ProjectManager\Entities\Project';
    }
    
    public function isOwner($projectId, $userId)
    {
        if (count($this->findWhere(['id' => $projectId, 'owner_id' => $userId]))) {
            return true;
        }
        return false;
    }
    
    public function hasMember($projectId, $memberId)
    {
        $project = $this->find($projectId);
        
        foreach ($project->members as $member) {
            if ($member->id == $memberId) {
                return true;
            }
        }
        return false;
    }
    
    public function presenter() 
    {
        return ProjectPresenter::class;
    }
}
