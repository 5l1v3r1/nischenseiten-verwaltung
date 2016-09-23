<?php

namespace App\Policies;

use App\User;
use App\Idea;
use Illuminate\Auth\Access\HandlesAuthorization;

class IdeaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the idea.
     *
     * @param App\User $user
     * @param App\Idea $idea
     *
     * @return mixed
     */
    public function view(User $user, Idea $idea)
    {
        return true;
    }

    /**
     * Determine whether the user can create ideas.
     *
     * @param App\User $user
     *
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the idea.
     *
     * @param App\User $user
     * @param App\Idea $idea
     *
     * @return mixed
     */
    public function update(User $user, Idea $idea)
    {
        if ($user->role->level > 90) {
            return true;
        }

        if ($user->id == $idea->user_id) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the idea.
     *
     * @param App\User $user
     * @param App\Idea $idea
     *
     * @return mixed
     */
    public function delete(User $user, Idea $idea)
    {
        if ($user->role->level > 90) {
            return true;
        }

        if ($user->id == $idea->user_id) {
            return true;
        }

        return false;
    }
}
