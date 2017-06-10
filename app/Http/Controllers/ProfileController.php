<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    /**
     * Display profile edit form
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('users.profile');
    }

    /**
     * Update user profile
     *
     * @param  Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        if ($request->hasFile('avatar') && $request->file('avatar')->isValid())
            $this->updateAvatar($request);

        if ($request->has('email'))
            $this->updateEmail($request);

        return back();
    }

    /**
     * Store and save new user avatar
     *
     * @param  \Illuminate\Http\Request $request
     * @return mixed
     */
    public function updateAvatar($request)
    {
        $this->validate($request, [
            'avatar' => 'mimes:jpg,jpeg,png,bmp',
        ]);

        $user = auth()->user();

        $oldAvatar = $user->avatar;
        $avatar = $this->storeAvatar($request);

        $user->avatar = $avatar->basename;
        $user->save();

        if ($oldAvatar != 'user.svg')
            unlink(storage_path('app/public/avatars/' . $oldAvatar));
    }

    /**
     * Save avatar image on disk
     *
     * @param \Illuminate\Http\Request $request
     * @return Image
     */
    public function storeAvatar($request)
    {
        $user = $request->user();
        $file = uniqid($user->name) . '.' . $request->avatar->extension();

        return Image::make($request->avatar)
            ->resize(256, 256, function ($constraint) {
                $constraint->upsize();
            })
            ->save(storage_path('app/public/avatars/' . $file));
    }

    /**
     * Update user email address
     *
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
    public function updateEmail($request)
    {
        $user = User::where('email', '=', $request->email)->first();
        if ($user)
            return back()->withErrors(['email' => 'Email already in use']);

        if ($request->email !== $request->email_confirmation)
            return back()->withErrors(['email_confirmation' => 'Emails do not match']);

        $this->validate($request, [
            'email' => 'required',
        ]);

        $request->user()->fill([
            'email' => $request->email,
        ])->save();

        return back()->with('flash', 'Email updated');
    }
}
