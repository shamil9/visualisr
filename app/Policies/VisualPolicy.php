<?php

namespace App\Policies;

use App\User;
use App\Visual;
use Illuminate\Auth\Access\HandlesAuthorization;

class VisualPolicy
{
    use HandlesAuthorization;

    public function before()
    {
        if (auth()->user()->admin) return true;
        if (auth()->user()->banned || ! auth()->user()->active) return false;
    }

    /**
     * Determine whether the user can view the visual.
     *
     * @param  \App\User   $user
     * @param  \App\Visual $visual
     * @return mixed
     */
    public function view(User $user, Visual $visual)
    {

    }

    /**
     * Determine whether the user can create visuals.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        if (auth()->check()) return true;
    }

    /**
     * Determine whether the user can update the visual.
     *
     * @param  \App\User   $user
     * @param  \App\Visual $visual
     * @return mixed
     */
    public function update(User $user, Visual $visual)
    {
        return $user->id === $visual->user_id;
    }

    /**
     * Determine whether the user can delete the visual.
     *
     * @param  \App\User   $user
     * @param  \App\Visual $visual
     * @return mixed
     */
    public function delete(User $user, Visual $visual)
    {
        return $user->id === $visual->user_id;
    }

    /**
     * Private visual should be visible only to it's owner
     *
     * @param  User   $user   [description]
     * @param  Visual $visual [description]
     * @return mixed
     */
    public function viewPrivateVisual(User $user, Visual $visual)
    {
        if ($visual->user_id === $user->id) return true;
        if ($visual->private) return false;
    }

    /**
     * Only logged in and confirmed users can rate
     *
     * @param  User   $user
     * @param  Visual $visual
     * @return mixed
     */
    public function rate(User $user, Visual $visual)
    {
        if ($visual->user_id !== $user->id && auth()->check()) return true;
    }
}
