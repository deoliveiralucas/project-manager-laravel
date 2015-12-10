<?php

namespace ProjectManager\Transformers;

use ProjectManager\Entities\Project;
use League\Fractal\TransformerAbstract;

class ProjectTransformer extends TransformerAbstract
{
    
    protected $defaultIncludes = ['members', 'client'];
    
    public function transform(Project $project)
    {
        return [
            'project_id' => $project->id,
            'client_id' => $project->client_id,
            'owner_id' => $project->owner_id,
            'name' => $project->name,
            'description' => $project->description,
            'progress' => (int) $project->progress,
            'status' => (int) $project->status,
            'due_date' => $project->due_date,
            'is_member' => $project->owner_id != \Authorizer::getResourceOwnerId()
        ];
    }
    
    public function includeMembers(Project $project)
    {
        return $this->collection($project->members, new UserTransformer());
    }
    
    public  function includeClient(Project $project)
    {
        return $this->item($project->client, new ClientTransformer());
    }
}
