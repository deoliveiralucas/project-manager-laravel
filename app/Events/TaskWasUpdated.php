<?php

namespace ProjectManager\Events;

use ProjectManager\Entities\ProjectTask;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class TaskWasUpdated extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $task;

    public function __construct($task)
    {
        $this->task = $task;
    }

    public function broadcastOn()
    {
        return ['user.' . \Authorizer::getResourceOwnerId()];
    }
}
