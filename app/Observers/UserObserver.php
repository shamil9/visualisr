<?php

namespace App\Observers;

use App\Helpers\Utility;
use App\Mail\UserCreated;
use App\User;

class UserObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  User $user
     * @return void
     */
    public function created(User $user)
    {
        \Mail::to($user)->send(new UserCreated($user));
    }

    /**
     * Listen to the User deleting event.
     *
     * @param  User $user
     * @return void
     */
    public function deleting(User $user)
    {
        $user->visuals()->delete();
        $dir = public_path() . '/uploads/visuals/' . $user->id;

        Utility::deleteDirectory($dir);
    }
}
