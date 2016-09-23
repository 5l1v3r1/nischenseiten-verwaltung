<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * Get the owner of this project.
     */
    public function owner()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
