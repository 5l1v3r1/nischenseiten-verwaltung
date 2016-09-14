<?php

namespace App\Policies;

use App\User;
use App\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{

    use HandlesAuthorization;

    /**
     * Determine whether the user can view the idea.
     *
     * @param  App\User  $user
     * @return mixed
     */
    public function view(User $user)
    {
        if ($user->role->level > 90)
        {
            return true;
        }

        return false;
    }

}
