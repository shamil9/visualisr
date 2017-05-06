<?php

namespace App\Policies;

use App\Comment;
use App\User;
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

    public function before()
    {
        if (auth()->user()->banned) return false;
    }

    public function create()
    {
        if (! auth()->check()) return false;

        return true;
    }

    public function update(User $user, Comment $comment)
    {
        if ($user->id !== $comment->user_id) return false;

        return true;
    }

    public function destroy()
    {
        if (auth()->user()->admin) return true;
    }
}
