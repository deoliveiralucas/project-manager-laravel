<?php

namespace ProjectManager\Entities;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name',
        'responsible',
        'email',
        'phone',
        'address',
        'obs'
    ];
    
    public function projects()
    {
        return $this->hasMany(\ProjectManager\Entities\Project::class);
    }
}
