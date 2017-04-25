<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function create()
    {
        if (! auth()->check()) return false;

        return true;
    }
}
