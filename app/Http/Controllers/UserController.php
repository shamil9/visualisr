<?php

namespace App\Http\Controllers;

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
