<?php

namespace App\Policies;

use App\User;
use App\IdeaCategory;
use Illuminate\Auth\Access\HandlesAuthorization;

class IdeaCategoryPolicy
{

    use HandlesAuthorization;

    /**
     * Determine whether the user can view the ideacategory.
     *
     * @param App\User         $user
     * @param App\IdeaCategory $ideacategory
     *
     * @return bool
     */
    public function view(User $user, IdeaCategory $ideacategory)
    {
        if ($user->role->level > 90) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create ideacategories.
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
     * Determine whether the user can update the ideacategory.
     *
     * @param App\User         $user
     * @param App\IdeaCategory $ideacategory
     *
     * @return bool
     */
    public function update(User $user, IdeaCategory $ideacategory)
    {
        if ($user->role->level > 90) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the ideacategory.
     *
     * @param App\User         $user
     * @param App\IdeaCategory $ideacategory
     *
     * @return bool
     */
    public function delete(User $user, IdeaCategory $ideacategory)
    {
        if ($user->role->level > 90) {
            return true;
        }

        return false;
    }
}
