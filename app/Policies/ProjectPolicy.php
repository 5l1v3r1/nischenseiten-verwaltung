<?php

namespace App\Policies;

use App\User;
use App\Project;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{

    use HandlesAuthorization;

    /**
     * Determine whether the user can view the idea.
     *
     * @param App\User    $user
     * @param App\Project $project
     *
     * @return bool
     */
    public function view(User $user, Project $project)
    {
        if ($user->role->level > 90) {
            return true;
        }

        if ($user->id === $project->user_id) {
            return true;
        }

        return false;
    }

    public function view_projectlist(User $user, Project $project)
    {
        return true;
    }

    /**
     * Determine whether the user can change the project.
     *
     * @param App\User    $user
     * @param App\Project $project
     *
     * @return bool
     */
    public function change_project(User $user, Project $project)
    {
        if ($user->role->level > 90) {
            return true;
        }

        if ($user->id === $project->user_id) {
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
        return true;
    }

    /**
     * Determine whether the user can update the idea.
     *
     * @param App\User    $user
     * @param App\Project $project
     *
     * @return bool
     */
    public function update(User $user, Project $project)
    {
        if ($user->role->level > 90) {
            return true;
        }

        if ($user->id === $project->user_id) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the idea.
     *
     * @param App\User    $user
     * @param App\Project $project
     *
     * @return bool
     */
    public function delete(User $user, Project $project)
    {
        if ($user->role->level > 90) {
            return true;
        }

        if ($user->id === $project->user_id) {
            return true;
        }

        return false;
    }
}
