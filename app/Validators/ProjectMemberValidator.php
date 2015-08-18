<?php

namespace ProjectManager\Validators;

use \Prettus\Validator\LaravelValidator;

class ProjectMemberValidator extends LaravelValidator
{
    protected $rules = [
        'project_id' => 'required|interger',
        'user_id' => 'required|interger'
    ];
}
