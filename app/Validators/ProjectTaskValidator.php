<?php

namespace ProjectManager\Validators;

use \Prettus\Validator\LaravelValidator;

class ProjectTaskValidator extends LaravelValidator
{
    protected $rules = [
        'name' => 'required',
        'project_id' => 'required|interger',
        'start_date' => 'required',
        'due_date' => 'required',
        'status' => 'required|interger'
    ];
}
