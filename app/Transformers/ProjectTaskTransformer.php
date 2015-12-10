<?php

namespace ProjectManager\Transformers;

use ProjectManager\Entities\ProjectTask;
use League\Fractal\TransformerAbstract;

class ProjectTaskTransformer extends TransformerAbstract
{

    public function transform(ProjectTask $projectTask)
    {
        return [
            'id' => $projectTask->id,
            'name' => $projectTask->name,
            'project_id' => $projectTask->project_id,
            'start_date' => $projectTask->start_date,
            'due_date' => $projectTask->due_date,
            'status' => (int) $projectTask->status,
        ];
    }
    
}
