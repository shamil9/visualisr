<?php

namespace App\Http\Controllers\Auth\Providers;

use App\User;
use Laravel\Socialite\Facades\Socialite;

class Twitter
{
    /**
     * Redirect the user to the twitter authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('twitter')->redirect();
    }

    /**
     * Obtain the user information from twitter.
     *
     * @return Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('twitter')->user();
        $localUser = User::where('twitter_id', $user->id)->first();

        if ($localUser)
            return $this->logginUser($localUser);

        if (auth()->check())
            return $this->updateUser($user);

        $localUser = $this->createUser($user);
        \Auth::login($localUser, true);

        return redirect(route('user.home'));
    }

    /**
     * If user is logged in and dont have Twitter acount linked
     * @param  $user
     * @return Illuminate\Http\RedirectResponse
     */
    private function updateUser($user)
    {
        User::where(['id' => auth()->user()->id])
            ->update([
                'twitter_id' => $user->id,
                'twitter_name' => $user->nickname,
                'twitter_profile_background_color' => $user->user['profile_background_color'],
                'twitter_profile_link_color' => $user->user['profile_link_color'],
                'twitter_profile_image_url' => $user->user['profile_image_url'],
            ]);

        return redirect(route('user.home'));
    }

    /**
     * If user is loggin in via Twitter
     * @param  $user
     * @return Illuminate\Http\RedirectResponse
     */
    private function logginUser($user)
    {
       \Auth::login($user, true);

       return redirect(route('user.home'));
    }

    /**
     * Create new user
     * @param  $user
     * @return User           New User instance
     */
    private function createUser($user)
    {
        return User::create([
            'twitter_id' => $user->id,
            'twitter_name' => $user->nickname,
            'twitter_profile_background_color' => $user->user['profile_background_color'],
            'twitter_profile_link_color' => $user->user['profile_link_color'],
            'twitter_profile_image_url' => $user->user['profile_image_url'],
            'twitter_avatar' => $user->avatar,
            'email' => $user->email,
            'password' => str_random(8),
            'name' => $user->nickname,
        ]);
    }
}
