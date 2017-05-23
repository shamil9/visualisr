<?php

namespace App\Http\Controllers\Auth\Providers;

use App\User;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class Twitter
{
    /**
     * Redirect the user to the twitter authentication page.
     */
    public function redirectToProvider()
    {
        return Socialite::driver('twitter')->redirect();
    }

    /**
     * Obtain the user information from twitter.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function handleProviderCallback()
    {
        if (request()->query->has('denied'))
            return redirect(route('user.home'))
                ->with('flash', 'Unable to link Twitter account');

        $user = Socialite::driver('twitter')->user();
        $localUser = User::where('twitter_id', $user->id)->first();

        if ($localUser)
            return $this->logginUser($localUser);

        if (auth()->check())
            return $this->updateUser($user);

        $localUser = $this->createUser($user);
        \Auth::login($localUser, true);

        return redirect(route('user.home'))
            ->with('flash', 'Twitter account successfully linked');
    }

    /**
     * If user is logged in and don't have Twitter account linked
     *
     * @param  $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    private function updateUser($user)
    {
        User::where(['id' => auth()->user()->id])
            ->update([
                'twitter_id'                       => $user->id,
                'twitter_name'                     => $user->nickname,
                'twitter_profile_background_color' => $user->user['profile_background_color'],
                'twitter_profile_link_color'       => $user->user['profile_link_color'],
                'twitter_profile_image_url'        => $user->user['profile_image_url'],
            ]);

        return redirect(route('user.home'));
    }

    /**
     * If user is login in via Twitter
     *
     * @param  $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    private function logginUser($user)
    {
        \Auth::login($user, true);

        return redirect(route('user.home'));
    }

    /**
     * Create new user
     *
     * @param  $user
     * @return User           New User instance
     */
    private function createUser($user)
    {
        return User::create([
            'twitter_id'                       => $user->id,
            'twitter_name'                     => $user->nickname,
            'twitter_profile_background_color' => $user->user['profile_background_color'],
            'twitter_profile_link_color'       => $user->user['profile_link_color'],
            'twitter_profile_image_url'        => $user->user['profile_image_url'],
            'twitter_avatar'                   => $user->avatar,
            'email'                            => $user->email,
            'password'                         => str_random(8),
            'name'                             => Str::slug($user->nickname),
        ]);
    }

    /**
     * Unlink users Twitter account
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unlinkAccount()
    {
        auth()->user()->update([
            'twitter_id'                       => '',
            'twitter_name'                     => '',
            'twitter_profile_background_color' => '',
            'twitter_profile_link_color'       => '',
            'twitter_profile_image_url'        => '',
            'twitter_avatar'                   => '',
        ]);

        return back()->with('flash', 'Twitter account successfully removed');
    }
}
