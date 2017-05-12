<?php

namespace App\Http\Controllers;

use App\Favorite;
use App\Mail\UserSuspendedMail;
use App\Mail\UserUnblockedMail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth', 'banned.check'], ['except' => ['show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('manage', User::class);
        $users = User::with('visuals')
            ->orderBy('id', 'desc')
            ->paginate(9);

        return view('admin.users.index', ['users' => $users]);
    }


    /**
     * Display the specified resource.
     *
     * @param User $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $user = User::where(['slug' => $slug])
            ->with('visuals.user')
            ->orderBy('id', 'desc')
            ->firstOrFail();

        $visuals = $user->visuals->map(function ($visual) {
            return $visual->id;
        });

        $likes = Favorite::whereIn('visual_id', $visuals->toArray())->get()->count();

        return view('users.show', compact('user', 'likes'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy(User $user)
    {
        $this->authorize('manage', User::class);
        $user->delete();

        return back()->with('flash', 'User deleted successfully');
    }

    /**
     * Block or unblock an user
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleUserBannedStatus(User $user)
    {
        $this->authorize('manage', User::class);
        if ($user->banned) {
            $user->banned = ! $user->banned;
            Mail::to($user->email)->send(new UserUnblockedMail($user));

            $user->save();

            return back()->with('flash', 'User successfully updated');
        }

        if (! $user->banned) {
            $user->banned = ! $user->banned;
            Mail::to($user->email)->send(new UserSuspendedMail($user));

            $user->save();

            return back()->with('flash', 'User successfully updated');
        }

    }
}
