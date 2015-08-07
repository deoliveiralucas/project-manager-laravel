<?php

namespace ProjectManager\Validators;

use \Prettus\Validator\LaravelValidator;

class ProjectValidator extends LaravelValidator
{
    protected $rules = [
        'name' => 'required|max:255',
    ];
}
