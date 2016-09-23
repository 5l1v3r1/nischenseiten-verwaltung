<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IdeaCategory extends Model
{
    /**
     * Get the amount of ideas this categorie has.
     */
    public function ideaCount()
    {
        return $this->hasMany('App\Idea', 'idea_category_id', 'id');
    }

    /**
     * Get the category owner.
     */
    public function owner()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
