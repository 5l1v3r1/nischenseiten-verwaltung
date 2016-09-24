<?php

namespace App\Policies;

use App\User;
use App\Competition;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompetitionPolicy
{

    use HandlesAuthorization;

    /**
     * Determine whether the user can view the competition.
     *
     * @param App\User        $user
     * @param App\Competition $competition
     *
     * @return bool
     */
    public function view(User $user, Competition $competition)
    {
        return true;
    }

    /**
     * Determine whether the user can create competitions.
     *
     * @param App\User $user
     *
     * @return bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the competition.
     *
     * @param App\User        $user
     * @param App\Competition $competition
     *
     * @return bool
     */
    public function update(User $user, Competition $competition)
    {
        if ($user->role->level > 90) {
            return true;
        }

        if ($user->id === $competition->project->user_id) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the competition.
     *
     * @param App\User        $user
     * @param App\Competition $competition
     *
     * @return bool
     */
    public function delete(User $user, Competition $competition)
    {
        if ($user->role->level > 90) {
            return true;
        }

        if ($user->id === $competition->project->user_id) {
            return true;
        }

        return false;
    }
}
