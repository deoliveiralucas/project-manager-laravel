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
        return $this->hasOne(User::class, 'id');
    }
    
    public function client()
    {
        return $this->hasOne(Client::class, 'id');
    }
    
    public function notes()
    {
        return $this->hasMany(ProjectNote::class);
    }
    
    public function tasks()
    {
        return $this->hasMany(ProjectTask::class);
    }
    
    public function members()
    {
        return $this->hasMany(ProjectMember::class);
    }
}
