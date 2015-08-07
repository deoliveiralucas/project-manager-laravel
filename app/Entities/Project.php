<?php

namespace ProjectManager\Entities;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'id',
        'owner_id',
        'client_id',
        'name',
        'description',
        'progress',
        'status',
        'due_date',
    ];
    
    public function user()
    {
        return $this->hasOne(\ProjectManager\Entities\User::class, 'id');
    }
    
    public function client()
    {
        return $this->hasOne(\ProjectManager\Entities\Client::class, 'id');
    }
}
