<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartnerProgram extends Model
{

    /**
     * Get all ideas (and its amount) this program has.
     */
    public function ideaCount()
    {
        return $this->hasMany('App\Idea', 'partner_program_id', 'id');
    }

    /**
     * Get the user who created this program.
     */
    public function owner()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

}
