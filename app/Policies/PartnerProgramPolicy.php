<?php

namespace App\Policies;

use App\User;
use App\PartnerProgram;
use Illuminate\Auth\Access\HandlesAuthorization;

class PartnerProgramPolicy
{

    use HandlesAuthorization;

    /**
     * Determine whether the user can view the idea.
     *
     * @param App\User           $user
     * @param App\PartnerProgram $partner_program
     *
     * @return bool
     */
    public function view(User $user, PartnerProgram $partner_program)
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
     * @return bool
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
     * @param App\User           $user
     * @param App\PartnerProgram $partner_program
     *
     * @return bool
     */
    public function update(User $user, PartnerProgram $partner_program)
    {
        if ($user->role->level > 90) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the idea.
     *
     * @param App\User           $user
     * @param App\PartnerProgram $partner_program
     *
     * @return bool
     */
    public function delete(User $user, PartnerProgram $partner_program)
    {
        if ($user->role->level > 90) {
            return true;
        }

        return false;
    }
}
