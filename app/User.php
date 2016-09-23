<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'note',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the users role/group.
     */
    public function role()
    {
        return $this->hasOne('App\Role', 'id', 'role_id');
    }

    /**
     * Get all projects created by this user.
     */
    public function projects()
    {
        return $this->hasMany('App\Project', 'user_id', 'id');
    }

    /**
     * Get all notes created by this user.
     */
    public function notes()
    {
        return $this->hasMany('App\Note', 'user_id', 'id');
    }

    /**
     * Get all ideas created by this user.
     */
    public function ideas()
    {
        return $this->hasMany('App\Idea', 'user_id', 'id');
    }

    /**
     * Get all categories created by this user.
     */
    public function categories()
    {
        return $this->hasMany('App\IdeaCategory', 'user_id', 'id');
    }

    /**
     * Get all partnerprograms created by this user.
     */
    public function programs()
    {
        return $this->hasMany('App\PartnerProgram', 'user_id', 'id');
    }
}
