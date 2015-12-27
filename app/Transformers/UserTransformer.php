<?php

namespace ProjectManager\Transformers;

use ProjectManager\Entities\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{

    public function transform(User $member)
    {
        return [
            'user_id' => $member->id,
            'name'    => $member->name,
            'email'   => $member->email,
        ];
    }
}
