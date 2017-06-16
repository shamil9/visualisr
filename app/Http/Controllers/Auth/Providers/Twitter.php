<?php

namespace App\Http\Controllers\Auth\Providers;

use App\Mail\SocialAccountConfirmation;
use App\TwitterAccount;
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
        // If user cancels redirect back to profile home
        if (request()->query->has('denied'))
            return redirect(route('user.home'))
                ->with('flash', 'Unable to link Twitter account');

        $twitter = Socialite::driver('twitter')->user();
        $user = User::where('email', '=', $twitter->email)->first();
        $usernameExists = User::where('name', '=', $twitter->nickname)->first();
        $twitterAccount = TwitterAccount::where('account_id', $twitter->id)->first();

        // If logged in user upate account
        if (auth()->check())
            return $this->updateUser(auth()->user(), $twitter);

        // If user's account is already linked proceed to login
        if ($twitterAccount)
            return $this->logginUser($user);

        // If user exist, link the account
        if ($user)
            return $this->updateUser($user, $twitter);

        if ($usernameExists)
            return redirect(route('register'))
                ->with('status', "{$twitter->nickname} already in use");

        // If user does not exist create a new account and proceed to login
        $twitterAccount = $this->createUser($twitter);
        \Auth::login($twitterAccount, true);

        return redirect(route('user.home'))
            ->with('flash', 'Twitter account successfully linked');
    }

    /**
     * If user is logged in and don't have Twitter account linked
     *
     * @param  $user
     * @param  $twitter
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    private function updateUser($user, $twitter)
    {
        $twitterAccount = new TwitterAccount([
            'account_id'               => $twitter->id,
            'name'                     => $twitter->nickname,
            'profile_background_color' => $twitter->user['profile_background_color'],
            'profile_link_color'       => $twitter->user['profile_link_color'],
            'profile_image_url'        => $twitter->user['profile_image_url'],
        ]);

        $user->twitter()->save($twitterAccount);
        \Auth::login($user, true);

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
     * @param $twitter
     * @return User New User instance
     * @internal param $user
     */
    private function createUser($twitter)
    {
        $password = str_random(8);
        $user = User::create([
            'email'    => $twitter->email,
            'password' => bcrypt($password),
            'name'     => $twitter->nickname,
            'slug'     => Str::slug($twitter->nickname),
        ]);

        $this->updateUser($user, $twitter);
        \Mail::to($user->email)->queue(new SocialAccountConfirmation($user, $password));

        return $user;
    }

    /**
     * Unlink users Twitter account
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unlinkAccount()
    {
        $twitterAccount = TwitterAccount::where('user_id', '=', auth()->id());
        $twitterAccount->delete();

        return back()->with('flash', 'Twitter account successfully removed');
    }
}
