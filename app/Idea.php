<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{

    /**
     * Get the category that was assigned to this idea.
     */
    public function category()
    {
        return $this->hasOne('App\IdeaCategory', 'id', 'idea_category_id');
    }

    /**
     * Get the partnerprogram that was assigned to this idea.
     */
    public function partnerprogram()
    {
        return $this->hasOne('App\PartnerProgram', 'id', 'partner_program_id');
    }

    /**
     * Get the ideas owner.
     */
    public function owner()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

}
