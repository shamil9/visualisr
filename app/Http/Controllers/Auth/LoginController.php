<?php

namespace App\Http\Controllers\Auth;

use App\Events\CreateUserEvent;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

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
     * @return Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('twitter')->user();
        $localUser = null;

        try {
            $localUser = $this->findOrCreate($user);
        } catch (Exception $e) {
            abort(500, 'Error on registration/authentication using Twitter');
        } finally {
            \Auth::login($localUser, true);
        }

        return redirect($this->redirectTo);
    }

    /**
     * Find and return existing user otherwise create new one
     * @param  Response $user Returned user by the provider
     * @return User           News or existing User instance
     */
    private function findOrCreate($user)
    {
        return User::firstOrCreate(['twitter_id' => $user->id], [
            'twitter_profile_background_color' => $user->user['profile_background_color'],
            'twitter_profile_link_color' => $user->user['profile_link_color'],
            'twitter_profile_image_url' => $user->user['profile_image_url'],
            'email' => $user->email,
            'password' => str_random(8),
            'name' => $user->nickname,
            'avatar' => $user->avatar,
        ]);
    }
}
