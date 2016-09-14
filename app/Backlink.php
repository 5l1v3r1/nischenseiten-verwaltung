<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Backlink extends Model
{

    /**
     * Get the project of this backlink entry.
     */
    public function project()
    {
        return $this->hasOne('App\Project', 'id', 'project_id');
    }

}
