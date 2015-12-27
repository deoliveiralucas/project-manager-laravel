<?php

namespace ProjectManager\Transformers;

use ProjectManager\Entities\ProjectMember;
use League\Fractal\TransformerAbstract;

class ProjectMemberTransformer extends TransformerAbstract
{

    protected $defaultIncludes = ['user', 'project'];

    public function transform(ProjectMember $member)
    {
        return [
            'project_id' => $member->project_id,
            'user_id'    => $member->user_id,
        ];
    }

    public function includeUser(ProjectMember $member)
    {
        return $this->item($member->user, new UserTransformer(), $member->user_id);
    }

    public function includeProject(ProjectMember $member)
    {
        return $this->item($member->project, new ProjectTransformer(), $member->project_id);
    }
}
