<?php

namespace ProjectManager\Events;

use ProjectManager\Entities\ProjectTask;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class TaskWasIncluded extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $task;

    public function __construct(ProjectTask $task)
    {
        $this->task = $task;
    }

    public function broadcastOn()
    {
        return ['user.' . \Authorizer::getResourceOwnerId()];
    }
}
