<?php

namespace ProjectManager\Validators;

use \Prettus\Validator\LaravelValidator;

class ProjectNoteValidator extends LaravelValidator
{
    protected $rules = [
        'project_id' => 'required|interger',
        'title' => 'required',
        'note' => 'required'
    ];
}
