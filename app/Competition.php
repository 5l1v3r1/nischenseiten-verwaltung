<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{

    /**
     * Get the project of this competition entry.
     */
    public function project()
    {
        return $this->hasOne('App\Project', 'id', 'project_id');
    }

}
