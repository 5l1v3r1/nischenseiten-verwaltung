<?php

namespace App\Policies;

use App\User;
use App\Backlink;
use Illuminate\Auth\Access\HandlesAuthorization;

class BacklinkPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the backlink.
     *
     * @param App\User     $user
     * @param App\Backlink $backlink
     *
     * @return mixed
     */
    public function view(User $user, Backlink $backlink)
    {
        return true;
    }

    /**
     * Determine whether the user can create backlinks.
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
     * Determine whether the user can update the backlink.
     *
     * @param App\User     $user
     * @param App\Backlink $backlink
     *
     * @return mixed
     */
    public function update(User $user, Backlink $backlink)
    {
        if ($user->role->level > 90) {
            return true;
        }

        if ($user->id === $backlink->project->user_id) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the backlink.
     *
     * @param App\User     $user
     * @param App\Backlink $backlink
     *
     * @return mixed
     */
    public function delete(User $user, Backlink $backlink)
    {
        if ($user->role->level > 90) {
            return true;
        }

        if ($user->id === $backlink->project->user_id) {
            return true;
        }

        return false;
    }
}
