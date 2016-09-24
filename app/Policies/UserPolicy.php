<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{

    use HandlesAuthorization;

    /**
     * Determine whether the user can view the idea.
     *
     * @param App\User $user
     *
     * @return mixed
     */
    public function make_auto_login(User $user)
    {
        if ($user === null) {
            return false;
        }

        if ($user->role->level > 90) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can view the idea.
     *
     * @param App\User $user
     *
     * @return mixed
     */
    public function view(User $user)
    {
        if ($user->role->level > 90) {
            return true;
        }

        return false;
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
        if ($user->role->level > 90) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the idea.
     *
     * @param App\User $user
     *
     * @return mixed
     */
    public function update(User $user, User $current_user)
    {
        if ($user->role->level > 90) {
            return true;
        }

        if ($user->id === $current_user->id) {
            return true;
        }

        return false;
    }

    public function update_in_userlist(User $user, User $current_user)
    {
        if ($user->role->level > 90) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the idea.
     *
     * @param App\User $user
     *
     * @return mixed
     */
    public function delete(User $user)
    {
        if ($user->role->level > 90) {
            return true;
        }

        return false;
    }
}
