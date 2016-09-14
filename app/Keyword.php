<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{

    /**
     * Get the project of this keyword.
     */
    public function project()
    {
        return $this->hasOne('App\Project', 'id', 'project_id');
    }

}
