<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    public function tasks()
    {
        return $this->hasMany(Task::class, 'project_id');
    }
}
