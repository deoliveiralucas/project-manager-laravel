<?php

namespace ProjectManager\Validators;

use \Prettus\Validator\LaravelValidator;

class ProjectValidator extends LaravelValidator
{
    protected $rules = [
        'owner_id' => 'required|interger',
        'client_id' => 'required|interger',
        'name' => 'required|max:255',
        'progress' => 'required|numeric|max:100|min:0',
        'status' => 'required|numeric|max:10|min:0',
        'due_date' => 'required'
    ];
}
