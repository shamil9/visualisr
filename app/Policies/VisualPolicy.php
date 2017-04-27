<?php

namespace App\Policies;

use App\User;
use App\Visual;
use Illuminate\Auth\Access\HandlesAuthorization;

class VisualPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the visual.
     *
     * @param  \App\User  $user
     * @param  \App\Visual  $visual
     * @return mixed
     */
    public function view(User $user, Visual $visual)
    {

    }

    /**
     * Determine whether the user can create visuals.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {

    }

    /**
     * Determine whether the user can update the visual.
     *
     * @param  \App\User  $user
     * @param  \App\Visual  $visual
     * @return mixed
     */
    public function update(User $user, Visual $visual)
    {
        return $user->id === $visual->user_id;
    }

    /**
     * Determine whether the user can delete the visual.
     *
     * @param  \App\User  $user
     * @param  \App\Visual  $visual
     * @return mixed
     */
    public function delete(User $user, Visual $visual)
    {
        return $user->id === $visual->user_id;
    }

    public function viewPrivateVisual(User $user, Visual $visual)
    {
        if ($visual->user_id === $user->id) return true;
        if ($visual->private) return false;

        return true;
    }
}
