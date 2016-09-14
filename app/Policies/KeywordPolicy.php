<?php

namespace App\Policies;

use App\User;
use App\Keyword;
use Illuminate\Auth\Access\HandlesAuthorization;

class KeywordPolicy
{

    use HandlesAuthorization;

    /**
     * Determine whether the user can view the keyword.
     *
     * @param  App\User  $user
     * @param  App\Keyword  $keyword
     * @return mixed
     */
    public function view(User $user, Keyword $keyword)
    {
        return true;
    }

    /**
     * Determine whether the user can create keywords.
     *
     * @param  App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the keyword.
     *
     * @param  App\User  $user
     * @param  App\Keyword  $keyword
     * @return mixed
     */
    public function update(User $user, Keyword $keyword)
    {
        if ($user->role->level > 90)
        {
            return true;
        }
        if ($user->id === $keyword->project->user_id)
        {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the keyword.
     *
     * @param  App\User  $user
     * @param  App\Keyword  $keyword
     * @return mixed
     */
    public function delete(User $user, Keyword $keyword)
    {
        if ($user->role->level > 90)
        {
            return true;
        }
        if ($user->id === $keyword->project->user_id)
        {
            return true;
        }
        return false;
    }

}
