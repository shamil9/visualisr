<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlogPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function before(User $user)
    {
        if ($user->admin) return true;
    }

    public function update()
    {
        return false;
    }

    public function store()
    {
        return false;
    }

    public function destroy()
    {
        return false;
    }
}
