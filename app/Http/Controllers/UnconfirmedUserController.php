<?php

namespace App\Http\Controllers;

use App\Mail\UserCreated;
use App\UnconfirmedUser;
use App\User;
use Illuminate\Http\Request;

class UnconfirmedUserController extends Controller
{
    /**
     * Confirm users account
     *
     * @param  string $token Confirmation token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function confirm($token)
    {
        try {
            $user = UnconfirmedUser::where('token', '=', $token)
                ->get()
                ->first()
                ->setActive();
        } catch (Exception $e) {
            return abort(500, 'Error Token Not Found');
        } finally {
            \Mail::to($user)->queue(new UserCreated($user));

            return redirect(route('user.home'))->with('flash', 'Account successfully activated');
        }
    }
}
