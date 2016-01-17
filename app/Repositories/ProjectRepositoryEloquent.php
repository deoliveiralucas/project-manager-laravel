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
        if (count($this->skipPresenter()->findWhere(['id' => $projectId, 'owner_id' => $userId]))) {
            return true;
        }
        return false;
    }

    public function hasMember($projectId, $memberId)
    {
        $project = $this->skipPresenter()->find($projectId);

        foreach ($project->members as $member) {
            if ($member->id == $memberId) {
                return true;
            }
        }
        return false;
    }

    public function findOwner($userId, $limit = null, $collumns = [])
    {
        return $this->scopeQuery(function ($query) use ($userId) {
            return $query
                ->select('projects.*')
                ->where('projects.owner_id', '=', $userId);
        })->paginate($limit, $collumns);
    }

    public function findMember($userId, $limit = null, $collumns = [])
    {
        return $this->scopeQuery(function ($query) use ($userId) {
            return $query
                ->select('projects.*')
                ->join('project_members', 'project_members.project_id', '=', 'projects.id')
                ->where('project_members.user_id', '=', $userId);
        })->paginate($limit, $collumns);
    }

    /*
    public function findWithOwnerAndMember($userId)
    {
        return $this->scopeQuery(function ($query) use ($userId) {
            return $query
                ->select('projects.*')
                ->leftJoin('project_members', 'project_members.project_id', '=', 'projects.id')
                ->where('project_members.user_id', '=', $userId)
                ->unionAll($this->model->query()->getQuery()->where('owner_id', '=', $userId));
        })->all();
    }
    */

    public function presenter()
    {
        return ProjectPresenter::class;
    }
}
