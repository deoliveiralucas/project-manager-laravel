<?php

namespace ProjectManager\Validators;

use \Prettus\Validator\LaravelValidator;

class ClientValidator extends LaravelValidator
{
    protected $rules = [
        'name'        => 'required|max:255',
        'responsible' => 'required|max:255',
        'email'       => 'required|email',
        'phone'       => 'required',
        'address'     => 'required',
    ];
}
