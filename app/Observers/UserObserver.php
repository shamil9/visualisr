<?php

namespace App\Observers;

use App\Mail\ConfirmAccount;
use App\UnconfirmedUser;
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
        $this->sendConfirmation($user);
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
        $dir = storage_path('app/public/visuals/' . $user->id);

        \File::deleteDirectory($dir);
    }

    /**
     * Send email confirmation
     *
     * @param User $user
     */
    public function sendConfirmation(User $user)
    {
        $unconfirmedUser = UnconfirmedUser::create([
            'user_id' => $user->id,
            'token'   => hash('sha256', $user->name),
        ]);

        \Mail::to($user->email)->queue(new ConfirmAccount($unconfirmedUser));
    }
}
